<?php
require 'db.php'; // Ma'lumotlar bazasiga ulanish faylini qo'shish
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Foydalanuvchi kiritgan ma'lumotlarni olish
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Parolni xavfsiz saqlash

    // Username takrorlanishini tekshirish
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetchColumn() > 0) {
        echo "Bu foydalanuvchi allaqachon mavjud!";
    } else {
        // Foydalanuvchi ma'lumotlarini ma'lumotlar bazasiga qo'shish
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$first_name, $last_name, $email, $username, $password])) {
            header("Location: login.php");
            exit;
        } else {
            echo "Xatolik yuz berdi. Iltimos, qayta urinib ko'ring.";
        }
    }
}
?>



<div class="font-[sans-serif] bg-white md:h-screen">
      <div class="grid md:grid-cols-2 items-center gap-8 h-full">
        <div class="max-md:order-1 p-4 bg-gray-50 h-full">
          <img src="https://readymadeui.com/signin-image.webp" class="max-w-[80%] w-full h-full aspect-square object-contain block mx-auto" alt="login-image" />
        </div>
        <div class="flex items-center p-6 h-full w-full">





        <form class="max-w-lg w-full mx-auto" method="post">
            <div class="mb-8">
              <h3 class="text-blue-500 text-2xl font-bold max-md:text-center">Create an account</h3>
            </div>

            <div class="mb-3">
              <label class="text-gray-800 text-xs block mb-2">First Name *</label>
              <div class="relative flex items-center">
                
              <input name="first_name" type="text" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 pl-2 pr-8 py-3 outline-none" placeholder="Enter name" />
                
                
                
              </div>
            </div>

            <div class="mb-3">
              <label class="text-gray-800 text-xs block mb-2">Last Name *</label>
              <div class="relative flex items-center">
                <input name="last_name" type="text" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 pl-2 pr-8 py-3 outline-none" placeholder="Enter name" />
               
              </div>
            </div>

            <div>
              <label class="text-gray-800 text-xs block mb-2">Username *</label>
              <div class="relative flex items-center">
                <input name="username" type="text" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 pl-2 pr-8 py-3 outline-none" placeholder="Enter name" />
                
              </div>
            </div>



            <div class="mt-6">
              <label class="text-gray-800 text-xs block mb-2">Email</label>
              <div class="relative flex items-center">
                <input name="email" type="text" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 pl-2 pr-8 py-3 outline-none" placeholder="Enter email" />
            
              </div>
            </div>


            <div class="mt-6">
              <label class="text-gray-800 text-xs block mb-2">Password</label>
              <div class="relative flex items-center">
                <input name="password" type="password" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 pl-2 pr-8 py-3 outline-none" placeholder="Enter password" />

              </div>
            </div>










            <div class="flex items-center mt-6">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 rounded" />
              <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                I accept the <a href="javascript:void(0);" class="text-blue-500 font-semibold hover:underline ml-1">Terms and Conditions</a>
              </label>
            </div>

            <div class="mt-8">
              <button type="submit" class="w-full py-2.5 px-4 text-sm tracking-wider rounded bg-blue-600 hover:bg-blue-700 text-white focus:outline-none">
                Creat an account
              </button>
              <p class="text-sm mt-6 text-gray-800">Already have an account? <a href="login.php" class="text-blue-500 font-semibold hover:underline ml-1">Login here</a></p>
            </div>
          </form>




        </div>
      </div>
    </div>

<?php include 'partials/footer.php'; ?>
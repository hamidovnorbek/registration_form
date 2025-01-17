<?php

require 'partials/header.php';
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
      
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; 
            header("Location: index.php"); 
            exit;
        } else {
            echo "Parol noto'g'ri!";
        }
    } else {
        echo "Bunday foydalanuvchi mavjud emas!";
    }
}
?>


<div class="bg-gray-50 font-[sans-serif]">
      <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
  

          <div class="p-8 rounded-2xl bg-white shadow">
            <h2 class="text-gray-800 text-center text-2xl font-bold">Sign in</h2>
            
            
            <form class="mt-8 space-y-4" method="post">            
            <div>
                <label class="text-gray-800 text-sm mb-2 block">User name</label>
                <div class="relative flex items-center">
                  <input name="username" type="text" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter user name" />
                  
                </div>
              </div>

              <div>
                <label class="text-gray-800 text-sm mb-2 block">Password</label>
                <div class="relative flex items-center">
                  <input name="password" type="password" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter password" />
                </div>
              </div>


              <div class="!mt-8">
                <button type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  Sign in
                </button>
              </div>
              <p class="text-gray-800 text-sm !mt-8 text-center">Don't have an account? <a href="registr.php" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register here</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
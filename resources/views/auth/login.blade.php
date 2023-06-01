<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Management System - Login</title>
    <link rel="icon" type="image/png" href="img/pm.logo.png">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px #f9fafb inset !important;
            background-color: #f9fafb !important;
            color: #ed0808 !important;
            /*font-size: 10px !important;*/
        }
        /** {*/
        /*    border: 1px solid red !important;*/
        /*}*/
    </style>
</head>
<body>
<!-- component -->
<div class="h-screen md:flex bg-[url('assets/img/finalbg.jpg')] bg-top bg-cover">
{{--    <div class="relative overflow-hidden md:flex w-3/5 bg-gradient-to-tr from-red-900 to-blue-900 i justify-around items-center hidden">--}}
    <div class="relative overflow-hidden md:flex w-3/5  i justify-center items-start mt-20 hidden">
        <div class="flex flex-col justify-center items-center">
            <img src="img/company_logo.png" class="w-1/2 -mb-8" alt="">
            <h1 class="text-gray-900 font-medium tracking-tight text-3xl pl-10">Project Management System</h1>
            <p class="text-white mt-1"></p>
        </div>
    </div>

    <div class="flex md:w-2/5 justify-center py-10 items-start md:mt-20 ">
        <div class="w-4/5 md:w-[350px] h-2/4 md:h-[320px] bg-gray-50 py-3 px-4 rounded-xl flex flex-col items-center justify-center border border-gray-400">
            <form method="POST" action="{{ route('login') }}">
                @csrf
{{--                <div class="border rounded-lg px-2 py-2 bg-red-100 bg-gradient" id="error-message">--}}
{{--                        <div class="ml-2 text-gray-700 text-sm bread-words">You tried to access a module without sufficient privileges.</div>--}}
{{--                </div>--}}

                {{--            alerts--}}
                @if ($errors->any())
                    <div class="border rounded-lg px-2 py-2 bg-red-100 bg-gradient" id="error-message">
                        @foreach ($errors->all() as $error)
                            <div class="ml-2 text-gray-700 text-sm bread-words">{{$error}}</div>
                        @endforeach
                    </div>
                    <script>
                        // Get the error message container by its ID
                        var errorMessage = document.getElementById("error-message");

                        // If the error message container exists
                        if (errorMessage) {
                            // Hide the error message after 3 seconds
                            setTimeout(function() {
                                errorMessage.style.display = "none";
                            }, 5000);
                        }
                    </script>
                @endif

                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-gray-800 font-medium text-2xl mb-1">Login to Your Account</h1>
                    <p class="text-sm font-normal text-gray-600 mb-7">Enter your username & password to login</p>
                </div>
                <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                    </svg>
                    <input class="pl-2 outline-none border-none bg-gray-50 focus:text-gray-700 w-full text-gray-700 "
                           type="text" name="username" id="" value="{{old('username')}}"
                           placeholder="Username"/>
                </div>

                <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <input class="pl-2 outline-none border-none bg-gray-50 focus:text-gray-700 w-full text-gray-700"
                           type="password" name="password" id=""
                           placeholder="Password"/>
                </div>
                <button type="submit"
                        class="block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Login
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

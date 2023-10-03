<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-900">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ route('informer.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">К работе!</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Вход</a>
            @endauth
        </div>
    @endif
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <svg viewBox="1 0 780 113" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto text-gray-700 sm:h-12">
                <g xmlns="http://www.w3.org/2000/svg" id="Frame 1" transform="translate(-0.859985,-0.99313027)">
                    <path id="Vector" d="M 1.00002,5.18999 C 0.998702,4.82933 1.0686,4.47196 1.20571,4.13837 1.34282,3.80478 1.54444,3.50155 1.799,3.24605 2.05357,2.99056 2.35607,2.78784 2.68915,2.64952 3.02224,2.51119 3.37935,2.43999 3.74002,2.43999 H 45 c 8.2814,-0.05327 16.2456,3.18072 22.1454,8.99241 5.8998,5.8117 9.2533,13.7264 9.3246,22.0076 0,13.28 -8.81,24.1 -21.36,29.15 l 19.79,36.7 c 0.2695,0.4239 0.4168,0.914 0.4256,1.416 0.0089,0.503 -0.121,0.997 -0.3753,1.431 -0.2543,0.433 -0.6233,0.787 -1.0662,1.024 -0.4429,0.237 -0.9426,0.348 -1.4441,0.319 H 57.29 c -0.4688,0.025 -0.935,-0.084 -1.3441,-0.314 -0.4092,-0.23 -0.7442,-0.572 -0.9659,-0.986 L 35.79,63.93 h -16 v 36.81 c -0.0231,0.728 -0.326,1.419 -0.8456,1.929 C 18.4247,103.18 17.7283,103.47 17,103.48 H 3.74002 c -0.72669,0 -1.42362,-0.289 -1.93747,-0.803 -0.51385,-0.513 -0.80253,-1.21 -0.80253,-1.937 z M 43.43,48.49 c 7.65,0 14.29,-6.64 14.29,-14.72 C 57.6289,30.0355 56.0851,26.4837 53.4167,23.8694 50.7483,21.2552 47.1656,19.7845 43.43,19.77 H 19.91 v 28.72 z" fill="#0245ee"></path>
                    <path id="Vector_2" d="m 102.18,5.19 c 0,-0.72934 0.29,-1.42882 0.805,-1.94454 C 103.501,2.72973 104.201,2.44 104.93,2.44 h 58.74 c 0.361,0 0.718,0.0712 1.051,0.20952 0.333,0.13833 0.635,0.34105 0.89,0.59654 0.255,0.25549 0.456,0.55873 0.593,0.89232 0.137,0.33359 0.207,0.69096 0.206,1.05162 V 17 c 0.001,0.3607 -0.069,0.718 -0.206,1.0516 -0.137,0.3336 -0.338,0.6369 -0.593,0.8923 -0.255,0.2555 -0.557,0.4583 -0.89,0.5966 -0.333,0.1383 -0.69,0.2095 -1.051,0.2095 H 121 v 23.69 h 35.6 c 0.72,0.0225 1.403,0.3185 1.912,0.8275 0.51,0.5091 0.805,1.193 0.828,1.9125 v 12 c 0,0.7267 -0.289,1.4236 -0.803,1.9375 -0.513,0.5138 -1.21,0.8025 -1.937,0.8025 H 121 v 25.24 h 42.72 c 0.727,0 1.424,0.2887 1.937,0.8025 0.514,0.5139 0.803,1.2108 0.803,1.9375 v 11.84 c 0,0.727 -0.289,1.424 -0.803,1.937 -0.513,0.514 -1.21,0.803 -1.937,0.803 h -58.79 c -0.728,0 -1.426,-0.288 -1.941,-0.802 -0.515,-0.513 -0.806,-1.21 -0.809,-1.938 z" fill="#0245ee"></path>
                    <path id="Vector_3" d="m 192.54,5.19 c -0.001,-0.36066 0.069,-0.71803 0.206,-1.05162 0.137,-0.33359 0.338,-0.63683 0.593,-0.89232 0.255,-0.25549 0.557,-0.45821 0.89,-0.59654 C 194.562,2.5112 194.919,2.44 195.28,2.44 h 13.28 c 0.721,0.0249 1.407,0.32262 1.917,0.83305 0.51,0.51043 0.808,1.19553 0.833,1.91695 v 81 h 36.8 c 0.727,0 1.424,0.2887 1.937,0.8025 0.514,0.5139 0.803,1.2108 0.803,1.9375 v 11.81 c 0,0.727 -0.289,1.424 -0.803,1.937 -0.513,0.514 -1.21,0.803 -1.937,0.803 h -52.83 c -0.36,0 -0.716,-0.071 -1.049,-0.209 -0.332,-0.137 -0.634,-0.339 -0.888,-0.594 -0.255,-0.254 -0.457,-0.556 -0.594,-0.888 -0.138,-0.333 -0.209,-0.689 -0.209,-1.049 z" fill="#0245ee"></path>
                    <path id="Vector_4" d="m 272.78,5.19 c -10e-4,-0.36066 0.069,-0.71803 0.206,-1.05162 0.137,-0.33359 0.338,-0.63683 0.593,-0.89232 0.255,-0.25549 0.557,-0.45821 0.89,-0.59654 C 274.802,2.5112 275.159,2.44 275.52,2.44 h 58.74 c 0.728,0.00265 1.425,0.29355 1.938,0.80899 C 336.712,3.76442 337,4.46239 337,5.19 V 17 c 0,0.7293 -0.29,1.4288 -0.805,1.9445 -0.516,0.5158 -1.216,0.8055 -1.945,0.8055 h -42.71 v 23.69 h 35.65 c 0.721,0.02 1.408,0.3149 1.919,0.8242 0.511,0.5093 0.808,1.1946 0.831,1.9158 v 12 c -0.003,0.7276 -0.294,1.4245 -0.809,1.9381 -0.515,0.5136 -1.213,0.8019 -1.941,0.8019 h -35.65 v 25.24 h 42.72 c 0.726,0.0026 1.421,0.2922 1.935,0.8054 0.513,0.5133 0.802,1.2087 0.805,1.9346 v 11.84 c -0.003,0.728 -0.294,1.425 -0.809,1.938 -0.515,0.514 -1.213,0.802 -1.941,0.802 h -58.73 c -0.727,0 -1.424,-0.289 -1.937,-0.803 -0.514,-0.513 -0.803,-1.21 -0.803,-1.937 z" fill="#0245ee"></path>
                    <path id="Vector_5" d="m 356,6.2 c -0.22,-0.40482 -0.327,-0.86182 -0.308,-1.32241 0.018,-0.46058 0.161,-0.9075 0.414,-1.29324 0.252,-0.38573 0.604,-0.69584 1.019,-0.89735 0.414,-0.2015 0.876,-0.28686 1.335,-0.247 h 14.71 c 0.514,-0.00349 1.018,0.14199 1.451,0.41883 0.433,0.27685 0.776,0.67322 0.989,1.14117 l 27.71,62.1 h 1 L 432,4 c 0.21,-0.47592 0.555,-0.87996 0.992,-1.16244 C 433.43,2.55507 433.94,2.40647 434.46,2.41 h 14.72 c 0.458,-0.03789 0.919,0.04892 1.332,0.25124 0.413,0.20231 0.763,0.5126 1.015,0.89798 0.251,0.38539 0.393,0.83152 0.411,1.29113 0.018,0.45962 -0.088,0.91561 -0.308,1.31965 l -44.74,97.13 c -0.201,0.481 -0.542,0.89 -0.98,1.173 -0.437,0.284 -0.949,0.429 -1.47,0.417 H 403 c -0.521,0.014 -1.034,-0.131 -1.472,-0.415 -0.437,-0.284 -0.778,-0.693 -0.978,-1.175 z" fill="#0245ee"></path>
                    <path id="Vector_6" d="m 558.06,3.6 c 0.031,-0.70386 0.334,-1.36821 0.845,-1.85317 C 559.416,1.26187 560.095,0.994137 560.8,1 h 3.61 l 60,63.79 h 0.15 V 5.19 c -10e-4,-0.36066 0.069,-0.71803 0.206,-1.05162 0.137,-0.33359 0.338,-0.63682 0.593,-0.89232 0.255,-0.25549 0.557,-0.45821 0.89,-0.59653 C 626.582,2.5112 626.939,2.44 627.3,2.44 h 13.28 c 0.72,0.02504 1.404,0.3231 1.913,0.83377 0.509,0.51066 0.805,1.19571 0.827,1.91623 v 97.14 c -0.031,0.703 -0.334,1.366 -0.846,1.85 -0.511,0.483 -1.19,0.748 -1.894,0.74 h -3.47 L 576.82,38.67 h -0.14 v 62.07 c 0,0.36 -0.071,0.716 -0.209,1.049 -0.137,0.332 -0.339,0.634 -0.593,0.888 -0.255,0.255 -0.557,0.457 -0.889,0.594 -0.333,0.138 -0.689,0.209 -1.049,0.209 H 560.8 c -0.719,-0.025 -1.401,-0.322 -1.91,-0.83 -0.508,-0.509 -0.805,-1.191 -0.83,-1.91 z" fill="#0245ee"></path>
                    <path id="Vector_7" d="m 687.53,19.77 h -22.08 c -0.362,0 -0.721,-0.0718 -1.056,-0.2114 -0.334,-0.1396 -0.637,-0.3441 -0.892,-0.6017 -0.255,-0.2576 -0.456,-0.5632 -0.592,-0.8991 -0.136,-0.3359 -0.204,-0.6955 -0.2,-1.0578 V 5.19 c -0.001,-0.36066 0.069,-0.71803 0.206,-1.05162 0.137,-0.33359 0.338,-0.63683 0.593,-0.89232 0.255,-0.25549 0.557,-0.45821 0.89,-0.59654 C 664.732,2.5112 665.089,2.44 665.45,2.44 h 63.07 c 0.729,0 1.429,0.28973 1.945,0.80546 0.515,0.51572 0.805,1.2152 0.805,1.94454 V 17 c 0,0.7293 -0.29,1.4288 -0.805,1.9445 -0.516,0.5158 -1.216,0.8055 -1.945,0.8055 h -22.08 v 81 c -0.025,0.719 -0.322,1.401 -0.83,1.91 -0.509,0.508 -1.191,0.805 -1.91,0.83 h -13.43 c -0.719,-0.025 -1.401,-0.322 -1.91,-0.83 -0.508,-0.509 -0.805,-1.191 -0.83,-1.91 z" fill="#0245ee"></path>
                    <path id="Vector_8" d="M 539.43,99.73 495,2.59 C 494.815,2.09189 494.473,1.66743 494.026,1.38063 493.578,1.09383 493.05,0.960242 492.52,1 h -1.44 c -0.521,-0.013563 -1.034,0.1311 -1.472,0.41494 -0.437,0.28383 -0.778,0.69352 -0.978,1.17506 l -44.89,97.14 c -0.217,0.404 -0.322,0.859 -0.302,1.317 0.019,0.458 0.162,0.902 0.413,1.286 0.251,0.384 0.6,0.693 1.012,0.895 0.411,0.202 0.87,0.289 1.327,0.252 h 12.56 c 0.913,0.019 1.81,-0.249 2.562,-0.768 0.752,-0.519 1.322,-1.261 1.628,-2.122 l 28.29,-63.36 h 0.43 l 28.58,63.36 c 1,2 2,2.89 4.18,2.89 H 537 c 0.455,0.033 0.911,-0.057 1.32,-0.261 0.409,-0.203 0.755,-0.513 1.004,-0.896 0.248,-0.383 0.389,-0.826 0.407,-1.282 0.019,-0.456 -0.085,-0.909 -0.301,-1.311 z" fill="#ed2d24"></path>
                </g>
            </svg>
        </div>
        <div class="text-dark" >
            @auth
                <a style="color: #080101;font-size: 20px;text-decoration: none;" href="{{ route('informer.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Informer</a>
            @else
                <a style="color: #080101;font-size: 20px;text-decoration: none;" href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Informer</a>
            @endauth

        </div>
    </div>
</div>
</body>
</html>
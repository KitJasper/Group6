<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Lab</title>
    <script src="https://kit.fontawesome.com/cf223ee5eb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="icon" href="images/ctu5.png" type="image/x-icon">
    <meta http-equiv="Cache-control" content="no-cache">
    <!-- meta tag that disables caching for the page it is included on and it prevents the browser from storing a local copy. 
    This causes the browser to fetch a fresh copy of the page from the server each time the user visits. -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container w-full h-screen max-w-none">
        <div id="slider">
            <div class="overlay"></div>
            <ul id="wrapper">
                <li><img src="https://scontent.fceb1-1.fna.fbcdn.net/v/t39.30808-6/306825486_1759839847708185_264014589913629738_n.jpg?stp=cp6_dst-jpg&_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFMgbIlakZ47H1FVn2KmhB7e7n1a0IGhal7ufVrQgaFqQY7LnOLwH_gUo-cLWs6MnPpDi_gHe8NVxbtZJ7Iw5Yp&_nc_ohc=BK1y13j2voMAX8Dyeq4&_nc_ht=scontent.fceb1-1.fna&oh=00_AfA-WWfFjPhPOImCFnmOROv9ubI_10xKAJ3lqoM8LxK-2Q&oe=6548204Ehttps://scontent.fceb1-1.fna.fbcdn.net/v/t39.30808-6/306825486_1759839847708185_264014589913629738_n.jpg?stp=cp6_dst-jpg&_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFMgbIlakZ47H1FVn2KmhB7e7n1a0IGhal7ufVrQgaFqQY7LnOLwH_gUo-cLWs6MnPpDi_gHe8NVxbtZJ7Iw5Yp&_nc_ohc=BK1y13j2voMAX8Dyeq4&_nc_ht=scontent.fceb1-1.fna&oh=00_AfA-WWfFjPhPOImCFnmOROv9ubI_10xKAJ3lqoM8LxK-2Q&oe=6548204E"
                        alt=""></li>
                <li><img src="https://scontent.fceb1-1.fna.fbcdn.net/v/t39.30808-6/337514661_137034369316434_6423063135988787623_n.jpg?stp=cp6_dst-jpg&_nc_cat=108&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeGqXTv3ZZl4jsiLXqXwmy-73BUJwPsKjRPcFQnA-wqNE15FoVLoat7jRadUdoqzNKZW5vJHicFLnJsBC-5tvi7Q&_nc_ohc=pOXXImdJbhcAX8I4N67&_nc_ht=scontent.fceb1-1.fna&oh=00_AfBarlqCgurnVumlW4_XCYyo9DV2M6EXfHtcoBafQ6bfKw&oe=6547A095"
                        alt=""></li>
                <li><img src="https://scontent.fceb1-2.fna.fbcdn.net/v/t39.30808-6/374763635_672541794903673_4330645766256566250_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeF2okyiPuYKr9gxmYmqlEiIwbyPYDdqS3zBvI9gN2pLfFAnBkIq6VVN_7lCrv5ExCC6WMxRl3xSX48jpecB3j5T&_nc_ohc=xR6tu7S7alcAX8YbxiS&_nc_ht=scontent.fceb1-2.fna&oh=00_AfAcrFxun03Ac2KvCIjk6wYVTOmYTPgIvy6BmrvNfHDlHg&oe=65481C4B"
                        alt=""></li>
                <li><img src="https://scontent.fceb1-2.fna.fbcdn.net/v/t39.30808-6/336650281_610075913921693_2587514029007065372_n.jpg?stp=cp6_dst-jpg&_nc_cat=109&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeHX7kqU33i7B1sPtgAM9-hvTW8dJmZj5KBNbx0mZmPkoHY0mvrwp_Zhs9edj0sh760hkrpeNXD8U-hbZwRide7a&_nc_ohc=c3IDd49UABgAX90-bDA&_nc_ht=scontent.fceb1-2.fna&oh=00_AfDbeWBrGPmKJXfx5WwMt7vbNgEg3oyEMv4fbS-XzgMoyQ&oe=654939B7"
                        alt=""></li>
            </ul>
            <a id="prev" href="#"><i class="fa-solid fa-angles-left"></i></a>
            <a id="next" href="#"><i class="fa-solid fa-angles-right"></i></a>
        </div>
        <div class="text absolute top-2/5 border-2 text-gray-50 flex flex-col text-center items-center justify-center">
            <h1 class="font-bold text-xl ">Welcome to the<br>Computer Lab <br>Reservation System</S></h1>
            <div class="btn w-full flex flex-col items-center justify-center">
                <div class="login rounded-3xl hover:bg-black duration-500"><a href="login.php">Login</a></div>
                <div class="reg rounded-3xl hover:bg-black duration-500"><a href="registration.php">Register</a></div>
            </div>
        </div>
    </div>
</body>
<script>
    var slider = document.getElementById("slider");
    var sliderWidth = slider.offsetWidth;
    var slideList = document.getElementById("wrapper");
    var count = 1;
    var items = slideList.querySelectorAll("li").length;
    var prev = document.getElementById("prev");
    var next = document.getElementById("next");
    window.addEventListener('resize', function () {
        sliderWidth = slider.offsetWidth;
    });
    var prevSlide = function () {
        if (count > 1) {
            count = count - 2;
            slideList.style.left = "-" + count * sliderWidth + "px";
            count++;
        }

        else if (count = 1) {
            count = items - 1;
            slideList.style.left = "-" + count * sliderWidth + "px";
            count++;
        }
    };
    var nextSlide = function () {
        if (count < items) {
            slideList.style.left = "-" + count * sliderWidth + "px";
            count++;
        }
        else if (count = items) {
            slideList.style.left = "0px";
            count = 1;
        }
    };
    next.addEventListener("click", function () {
        nextSlide();
    });

    prev.addEventListener("click", function () {
        prevSlide();
    });
    setInterval(function () {
        nextSlide()
    }, 5000);
    window.onload = function () {
        responsiveSlider();
    }
</script>

</html>

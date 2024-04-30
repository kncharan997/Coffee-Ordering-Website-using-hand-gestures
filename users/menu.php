<?php
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils/control_utils.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Cafe GestureLink</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2Hhh_14Uam62GXGaTMcXWhhVkYg0EbDY&callback=initMap" async defer></script>

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/convo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><!-- font awesome cdn link -->
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.jpg"><!-- Favicon / Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->

    <style>
         #video-container {
            position: absolute;
    top: 1.5px; 
    right: 10px; 
    width: 20%;
    height: 20vh;
    margin-right: 280px; 
    border: 3px solid white; 
    box-sizing: border-box; 
    z-index: 110;
        }

        #video-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }
        #z{
            margin-right: 360px !important;
        }
        #ab{
            height: 170px !important;
        }
        #m{
            margin-top: 100px !important; 
            height: 600px !important;
            margin-right: 250px !important;
        }
        #mycart {
         max-height: 600px; /* Adjust the maximum height as needed */
          overflow-y: auto; /* Enable vertical scrolling if content exceeds maximum height */
        }
        #f{
            Display: none !important;
            height: 1vh !important;
        }
    </style>
</head>
<body>
<video class="input_video" hidden="hidden"></video>
    <!-- HEADER SECTION -->
    <header class="header" id = "ab">
        <a href="#" class="logo">
            <img src="../assets/images/logo.jpg" class="img-logo" alt="Cafe GestureLink Logo">
        </a>

        <!-- MAIN MENU FOR SMALLER DEVICES -->
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav mr-auto" id="z">
                <li class="nav-item">
                    <a href="index.php" class="text-decoration-none">Home</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?section=#menu" class="text-decoration-none">Menu</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?section=#about" class="text-decoration-none">About</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?section=#gallery" class="text-decoration-none">Gallery</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?section=#contact" class="text-decoration-none">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="text-decoration-none">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Video Container -->
        <canvas class="video-container" id="video-container" width="400px" height="600px"></canvas>

        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <!-- SEARCH TEXT BOX -->
        <div class="search-form">
            <input type="search" id="search-box" class="form-control" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>

        <!-- CART SECTION -->
        <div class="cart" id ="mycart">
            <h2 class="cart-title">Your Cart:</h2>
            <div class="cart-content">
            </div>
            <div class="total">
                <div class="total-title">Total: </div>
                <div class="total-price">₹0</div>
            </div>
            <!-- BUY BUTTON -->
            <button type="button" class="btn-buy" id = "checkout">Checkout Now</button>
        </div>
    </header>

         <!-- MENU SECTION -->
         <section class="menu" id="menu">
            <h1 class="heading">Our <span>Menu</span></h1>
            <div class="box-container" id="m">
                <div class="container" id="ma">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box" >
                                <img src="../assets/images/cart-item-1.png" alt="" class="product-img">
                                <h3 class="product-title">Americano - Hot Espresso      </h3>
                                <div class="price">₹45.00</div>
                                <a class="btn add-cart" id="a">Add to Cart</a>
                            </div>
                        </div><br />
                        <div class="col-md-4">
                            <div class="box">
                                <img src="../assets/images/cart-item-2.png" alt="" class="product-img">
                                <h3 class="product-title">Colombian Supremo Cup      </h3>
                                <div class="price">₹40.00</div>
                                <a class="btn add-cart" id="b">Add to Cart</a>
                            </div>
                        </div><br />
                        <div class="col-md-4">
                            <div class="box">
                                <img src="../assets/images/cart-item-3.png" alt="" class="product-img">
                                <h3 class="product-title">Nitro Cold Brew <br>w/ Straw      </h3>
                                <div class="price">₹50.00</div>
                                <a class="btn add-cart" id="c">Add to Cart</a>
                            </div>
                        </div>
                    </div><br />
                    <!-- <div class="row">
                        <div class="col-md-4">
                            <div class="box">
                                <img src="../assets/images/cart-item-4.png" alt="" class="product-img">
                                <h3 class="product-title">Seasonal Single-Origin (12 OZ)</h3>
                                <div class="price">₹30.00</div>
                                <a class="btn add-cart">Add to Cart</a>
                            </div>
                        </div><br />
                        <div class="col-md-4">
                            <div class="box">
                                <img src="../assets/images/cart-item-5.png" alt="" class="product-img">
                                <h3 class="product-title">Indonesian Sumatra Mandheling (12 OZ)</h3>
                                <div class="price">₹40.00</div>
                                <a class="btn add-cart">Add to Cart</a>
                            </div>
                        </div><br />
                        <div class="col-md-4">
                            <div class="box">
                                <img src="../assets/images/cart-item-6.png" alt="" class="product-img">
                                <h3 class="product-title">Mint Mojito Iced Coffee (12 OZ)</h3>
                                <div class="price">₹55.00</div>
                                <a class="btn add-cart">Add to Cart</a>
                            </div>
                        </div>
                    </div><br />  -->
                    <!-- <center>
                        <button id="showHideBtn" class="btn btn-dark">SHOW MORE</button>
                    </center>  -->
                </div>
            </div>
        </section>

        <!-- FOOTER SECTION-->
        <section class="footer" id ="f">
            <div class="footer-container">
                <div class="logo">
                    <img src="../assets/images/logo.png" class="img"><br />
                    <i class="fas fa-envelope"></i>
                    <p>CharanKN@gmail.com</p><br />
                    <i class="fas fa-phone"></i>
                    <p>+91 9980727790</p><br />
                    <i class="fab fa-facebook-messenger"></i>
                    <p>@Cafe GestureLink</p><br />
                </div>
                <div class="newsletters">
                    <h2>Newsletters</h2>
                    <br /> 
                    <p>Subscribe to our newsletter for news and updates!</p>
                    <div class="input-wrapper">
                        <input type="email" class="newsletter" placeholder="Your email address">
                        <i id="paper-plane-icon" class="fas fa-paper-plane"></i>
                    </div>
                </div>
                <div class="credit">
                    <hr /><br/>
                    <h2>Cafe GestureLink © 2024 </h2>
                    <h2>Designed by <span>Bhoomika P, Charan KN & Manjunath Ashok Nayak</span> | Teravision</h2>
                </div>
            </div>
        </section> 
        <<script>
            document.addEventListener("DOMContentLoaded", function () {
    // Function to update cart position
    function updateCartPosition() {
        const cart = document.getElementById('mycart');
        const windowHeight = window.innerHeight;
        const windowWidth = window.innerWidth;
        const cartHeight = cart.offsetHeight;
        const cartWidth = cart.offsetWidth;
        const cartMargin = 20; // Adjust as needed
        
        // Calculate new cart position
        const cartTop = windowHeight - cartHeight - cartMargin;
        const cartLeft = windowWidth - cartWidth - cartMargin;

        // Set cart position
        cart.style.top = cartTop + 'px';
        cart.style.left = cartLeft + 'px';
    }

    // Initial update of cart position
    updateCartPosition();

    // Update cart position when window is resized
    window.addEventListener('resize', function () {
        updateCartPosition();
    });
});

        </script>
        <script>

        document.addEventListener("DOMContentLoaded", function () {
        console.log("hello world!");
        const videoElement = document.getElementsByClassName("input_video")[0];
        const canvasElement = document.getElementsByClassName("video-container")[0];
        const canvasCtx = canvasElement.getContext("2d");

        let fingerCountHistory = []; // Array to store finger count history
        let fingerCountTimeout; // Timeout variable

        function countExtendedFingers(landmarks) {
            const fingerTips = [4, 8, 12, 16, 20]; // Indices of fingertip landmarks
            let count = 0;
            const tipThreshold = 0.9; // Adjust as needed
            for (let i = 0; i < fingerTips.length; i++) {
                const tipIndex = fingerTips[i];
                const tip = landmarks[tipIndex];
                const base = landmarks[tipIndex - 2];
                const middle = landmarks[tipIndex - 1];
                // Check if the tip is above the base and middle (open finger)
                if (tip && base && middle && tip.y < middle.y * tipThreshold && tip.y < base.y * tipThreshold) {
                    count++;
                }
            }
            return count;
        }

        function handleGesture(fingerCount) {
            let buttonClicked = false;
            switch (fingerCount) {
                case 1:
                    setTimeout(() => {
                        var addCartButton = document.getElementById('a');
                            addCartButton.click();
                            addCartButton.removeEventListener('click', addCartClicked);
                            buttonClicked = true; 
                    }, 5000);
                    break;
                case 2:
                    setTimeout(() => {
                        var addCartButton = document.getElementById('b');
                            addCartButton.click();
                            addCartButton.removeEventListener('click', addCartClicked);
                            buttonClicked = true;
                    }, 5000);

                    break;
                case 3:
                    setTimeout(() => {
                        var addCartButton = document.getElementById('c');
                            addCartButton.click();
                            addCartButton.removeEventListener('click', addCartClicked);
                            buttonClicked = true;
                    }, 5000);
                    break;
                case 4:
                    setTimeout(() => {
                        window.location.href = '';
                    }, 5000);
                    break;
                case 5:
                    setTimeout(() => {
                        var addCartButton = document.getElementById('checkout');
                            addCartButton.click();
                            addCartButton.addEventListener('click', buyButtonClicked);
                            buttonClicked = true;
                    }, 5000);
                    break;
                
                default:
                    // Handle unrecognized gestures or no gesture
                    break;
            }
        }
        function onResults(results) {
                    try {
                        canvasCtx.save();
                        canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
                        canvasCtx.drawImage(
                            results.image,
                            0,
                            0,
                            canvasElement.width,
                            canvasElement.height
                        );
                        if (results.multiHandLandmarks) {
                            for (const landmarks of results.multiHandLandmarks) {
                                drawConnectors(canvasCtx, landmarks, HAND_CONNECTIONS,
                                    { color: '#00FF00', lineWidth: 5 });
                                drawLandmarks(canvasCtx, landmarks, { color: '#FF0000', lineWidth: 2 });
                                const fingerCount = countExtendedFingers(landmarks);
                                console.log("Extended fingers:", fingerCount);
                                // Add the current finger count to the history
                                fingerCountHistory.push(fingerCount);
                                // Check if the last 3 seconds have had consistent finger count
                                if (fingerCountHistory.length >= 3) {
                                    const last3Seconds = fingerCountHistory.slice(-3);
                                    const uniqueFingerCounts = new Set(last3Seconds);
                                    if (uniqueFingerCounts.size === 1) {
                                        // If the finger count remains the same for 3 seconds
                                        clearTimeout(fingerCountTimeout);
                                        handleGesture(last3Seconds[0]);
                                    } else {
                                        // If the finger count changes within 3 seconds, restart the timeout
                                        clearTimeout(fingerCountTimeout);
                                        fingerCountHistory = [];
                                        fingerCountTimeout = setTimeout(() => {
                                            handleGesture(last3Seconds[last3Seconds.length - 1]);
                                        }, 3000);
                                    }
                                }
                            }
                        }
                        canvasCtx.restore();
                    } catch (error) {
                        console.log("error", error);
                    }
                }

                const hands = new Hands({
                    locateFile: (file) => {
                        return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
                    }
                });
                hands.setOptions({
                    maxNumHands: 1,
                    modelComplexity: 1,
                    minDetectionConfidence: 0.5,
                    minTrackingConfidence: 0.5,
                    selfieMode: true
                });
                hands.onResults(onResults);

                // Camera setup for mediapipe
                const camera = new Camera(videoElement, {
                    onFrame: async () => {
                        await hands.send({ image: videoElement });
                    },
                    width: 400,
                    height: 600
                });
                camera.start();
        });
        </script>
        <!-- JS File Link -->
        <script src="../assets/js/googleSignIn.js"></script>
        <script src="../assets/js/script.js"></script>
        <script src="../assets/js/responses.js"></script>
        <script src="../assets/js/convo.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
            // CODE FOR THE FORMSPREE
            window.onbeforeunload = () => {
                for(const form of document.getElementsByTagName('form')) {
                    form.reset();
                }
            }
            
            // CODE FOR THE GOOGLE MAPS API
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 14.99367271992383, lng: 120.17629231186626},
                    zoom: 9
                });

                var marker = new google.maps.Marker({
                    position: {lat: 14.99367271992383, lng: 120.17629231186626},
                    map: map,
                    title: 'Your Location'
                });
            }

            // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN MENU
            $(document).ready(function() {
                $(".row-to-hide").hide();
                $("#showHideBtn").text("SHOW MORE");
                $("#showHideBtn").click(function() {
                    $(".row-to-hide").toggle();
                    if ($(".row-to-hide").is(":visible")) {
                        $(this).text("SHOW LESS");
                    } else {
                        $(this).text("SHOW MORE");
                    }
                });
            });

            // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN GALLERY
            $(document).ready(function() {
                $(".pic-to-hide").hide();
                $("#showBtn").text("SHOW MORE");
                $("#showBtn").click(function() {
                    $(".pic-to-hide").toggle();
                    if ($(".pic-to-hide").is(":visible")) {
                        $(this).text("SHOW LESS");
                    } else {
                        $(this).text("SHOW MORE");
                    }
                });
            });
        </script> 
    </body>
</html>
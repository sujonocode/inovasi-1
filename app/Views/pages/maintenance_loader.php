 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Under Maintenance</title>
     <style>
         body {
             margin: 0;
             padding: 0;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 100vh;
             font-family: Arial, sans-serif;
             background: linear-gradient(135deg, #ff7e5f, #feb47b);
             color: #fff;
         }

         .container {
             text-align: center;
         }

         h1 {
             font-size: 3em;
             margin-bottom: 0.5em;
         }

         p {
             font-size: 1.5em;
             margin-bottom: 1em;
         }

         .loader {
             border: 5px solid rgba(255, 255, 255, 0.3);
             border-top: 5px solid #fff;
             border-radius: 50%;
             width: 50px;
             height: 50px;
             animation: spin 1s linear infinite;
             margin: 0 auto;
         }

         .image {
             max-width: 100%;
             height: auto;
             margin: 0 auto 1em;
             display: block;
         }

         @keyframes spin {
             0% {
                 transform: rotate(0deg);
             }

             100% {
                 transform: rotate(360deg);
             }
         }
     </style>
 </head>

 <body>
     <div class="container">
         <img src="<?= base_url('assets/image/maintenance.jpg') ?>" alt="Maintenance Image" class="image">
         <h1>We'll Be Back Soon!</h1>
         <p>Our website is currently under maintenance. Thank you for your patience.</p>
         <div class="loader"></div>
     </div>
 </body>

 </html>
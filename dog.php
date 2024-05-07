<?php
$pageTitre = "Dog";
$metaDescription = "Contactez-nous pour toute question!";
$currentPage = 'dog';
require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img id="img-dog" src="https://random.dog/b85472ed-141e-4a38-b5ee-d286a67e5681.JPG" alt="chien" width="50%">
    <button id="fetch-dog">
        Woof
    </button>
    <script>
        document.querySelector('#fetch-dog').addEventListener('click', async () => {
            refreshDog();
        })

        async function refreshDog() {
            var fetchResult = await fetch('https://random.dog/woof.json')
            var data = await fetchResult.json()

            if (data.url.includes('.mp4')) {
                refreshDog()
                return;
            }


            document.querySelector('#img-dog').src = data.url
        }
    </script>


</body>
</html>
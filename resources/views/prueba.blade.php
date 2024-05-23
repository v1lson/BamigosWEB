<?php
require __DIR__ . '/../../../app/Http/SourceQuery/bootstrap.php';

use App\Http\SourceQuery\SourceQuery;

// Edit this ->
define('SQ_SERVER_ADDR', '176.9.62.21');
define('SQ_SERVER_PORT', 10015);
define('SQ_TIMEOUT', 3);
define('SQ_ENGINE', SourceQuery::SOURCE);
// Edit this <-

$Query = new SourceQuery();

$Info = [];
$Rules = [];
$Players = [];
$Exception = null;

try {
    $Query->Connect(SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE);
    //$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound

    $Info = $Query->GetInfo();
} catch (Exception $e) {
    $Exception = $e;
} finally {
    $Query->Disconnect();
}

?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <title>Source Query PHP Library</title>
    @vite("resources/css/app.css")
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>

<div class="card w-80 h-12 shadow-xl image-full">
    <figure><img class="w-full" src="https://media.moddb.com/images/downloads/1/249/248576/A.png" alt="Mirage" /></figure>
    <div class="card-body flex-nowrap flex-row content-center justify-around">
        <div>
            <p class=""><?php echo $Info["HostName"]?></p>
            <div class="flex items-center">
                <progress class="progress progress-warning w-7" value="<?php echo $Info["Players"]?>" max="<?php echo $Info["MaxPlayers"]?>"></progress>
                <p class="text-xs"> <?php echo $Info["Map"]?><br>
                    <?php echo $Info["Players"]?>/<?php echo $Info["MaxPlayers"]?>
                </p>
            </div>
        </div>
        <div class="card-actions justify-end">
            <a href="steam://connect/<?php echo SQ_SERVER_ADDR?>:<?php echo SQ_SERVER_PORT?>">
                <svg width="24px" height="24px" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.6935 15.8458L15.4137 13.059C16.1954 12.5974 16.1954 11.4026 15.4137 10.941L10.6935 8.15419C9.93371 7.70561 9 8.28947 9 9.21316V14.7868C9 15.7105 9.93371 16.2944 10.6935 15.8458Z" fill="#ffffff"></path> </g></svg>
            </a>
        </div>
    </div>
</div>
</body>
</html>

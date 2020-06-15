<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css?v=<?= filemtime(FCPATH . '/css/app.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
<div id="app">
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <? if (User_model::is_logged()) { ?>
                    <li class="nav-item text-white">
                        Баланс: {{walletBalance}}$
                    </li>
                    <li class="nav-item text-white">
                        Лайки: {{likesBalance}}
                    </li>
                    <li class="nav-item text-white">
                        <button type="button" class="btn btn-warning my-2 my-sm-0" type="submit" data-toggle="modal"
                                data-target="#balanceHistoryModal" @click="loadBalanceHistory">История баланса
                        </button>
                    </li>
                    <li class="nav-item text-white">
                        <button type="button" class="btn btn-secondary my-2 my-sm-0" type="submit" data-toggle="modal"
                                data-target="#packsHistoryModal" @click="loadPacksHistory">История бустерпаков
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-success my-2 my-sm-0" type="submit" data-toggle="modal"
                                data-target="#addModal">Пополнить баланс
                        </button>
                    </li>
                <? } ?>
                <li class="nav-item">
                    <? if (User_model::is_logged()) { ?>
                        <a href="/main_page/logout" class="btn btn-primary my-2 my-sm-0"
                           data-target="#loginModal">Выйти, <?= $user->personaname ?>
                        </a>
                    <? } else { ?>
                        <button type="button" class="btn btn-success my-2 my-sm-0" type="submit" data-toggle="modal"
                                data-target="#loginModal">Вход
                        </button>
                    <? } ?>
                </li>
            </div>
        </nav>
    </div>


<template>

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Booking</router-link>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>
    </div>
</template>


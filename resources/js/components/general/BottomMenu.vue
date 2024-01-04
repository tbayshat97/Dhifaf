<template>
    <div class="col-12 col-md-12">
        <div class="header-links">
            <ul>
                <li class="nav-item header-icons">
                    <a class="nav-link" href="/"><i class='bx bx-home'></i></a>
                </li>
                <li class="nav-item header-icons">
                    <a class="nav-link" href="/wishlist"><i class='bx bxs-gift' ></i></a>
                </li>
                <li class="nav-item header-icons">
                    <a class="nav-link" href="/favorite"><i class='bx bxs-heart' ></i></a>
                </li>
                <li class="nav-item header-icons">
                    <a class="nav-link cart" href="/cart"><span>{{ $store.state.cartCount }}</span><i class='bx bxs-basket' ></i></a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['language'],
    };
</script>
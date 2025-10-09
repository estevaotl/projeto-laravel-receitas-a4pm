<template>
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-green-600">A4PM Receitas</a>
                </div>

                <!-- Menu -->
                <div class="flex items-center space-x-4">
                    <Link href="/login" class="px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition" id="botao-login">Login
                    </Link>
                    <Link href="/cadastro"
                        class="px-3 py-2 rounded-md text-white bg-green-600 hover:bg-green-700 transition" id="botao-cadastro">Cadastro
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: "Navbar",
    components: {
        Link
    }
};
</script>

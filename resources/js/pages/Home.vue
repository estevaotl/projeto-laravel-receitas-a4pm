<template>
    <div>
        <Navbar />

        <main class="flex flex-col items-center justify-center h-screen bg-gray-50">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Bem-vindo ao MinhaApp</h1>
            <p class="text-gray-600 mb-6 text-center max-w-xl">
                Esta é a página inicial. Faça login ou cadastre-se para continuar.
            </p>

            <div class="flex space-x-4">
                <Link href="/logar" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Login</Link>
                <Link href="/cadastro" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Cadastro</Link>
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import Navbar from "../components/Navbar.vue";
</script>

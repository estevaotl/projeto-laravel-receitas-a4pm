<template>
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-green-600">Olá, {{ auth.user.nome }}</h1>
        <button @click="logout" class="text-red-600 hover:underline">Sair</button>
    </nav>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'

const { auth } = defineProps<{
    auth: {
        user: {
            nome: string
        }
    },
}>();

function logout() {
    router.post('/logout')
}

</script>
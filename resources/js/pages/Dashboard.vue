<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps<{
    auth: {
        user: {
            nome: string
        }
    },
    receitas: {
        id: number
        titulo: string
        descricao: string
    }[]
}>()

function logout() {
    router.post('/logout')
}

function cadastrarReceita() {
    router.get('/receitas/criar')
}

function editarReceita(id: number) {
    router.get(`/receitas/${id}/editar`)
}

function excluirReceita(id: number) {
    if (confirm('Tem certeza que deseja excluir esta receita?')) {
        router.delete(`/receitas/${id}`)
    }
}

function imprimirReceita(id: number) {
    window.open(`/receitas/${id}/imprimir`, '_blank')
}
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navbar -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-green-600">Olá, {{ auth.user.nome }}</h1>
            <button @click="logout" class="text-red-600 hover:underline">Sair</button>
        </nav>

        <!-- Conteúdo -->
        <div class="max-w-4xl mx-auto py-10 px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Minhas Receitas</h2>
                <button @click="cadastrarReceita" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Nova Receita
                </button>
            </div>

            <div v-if="receitas.length === 0" class="text-gray-600">Você ainda não cadastrou nenhuma receita.</div>

            <div v-else class="space-y-4">
                <div v-for="receita in receitas" :key="receita.id" class="bg-white shadow rounded p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ receita.titulo }}</h3>
                    <p class="text-gray-600 mb-4">{{ receita.descricao }}</p>
                    <div class="flex space-x-2">
                        <button @click="editarReceita(receita.id)" class="text-blue-600 hover:underline">Editar</button>
                        <button @click="excluirReceita(receita.id)"
                            class="text-red-600 hover:underline">Excluir</button>
                        <button @click="imprimirReceita(receita.id)"
                            class="text-green-600 hover:underline">Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

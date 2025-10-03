<script setup lang="ts">
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps<{
    auth: {
        user: {
            nome: string
        }
    },
    receitas: {
        id: number
        nome: string
        modo_preparo: string
        ingredientes: string
        tempo_preparo_minutos: number
        porcoes: number
    }[]
}>()

const showModal = ref(false)
const isEditing = ref(false)
const receitaAtual = reactive({
    id: null,
    nome: '',
    modo_preparo: '',
    ingredientes: '',
    tempo_preparo_minutos: null,
    porcoes: null,
})

function logout() {
    router.post('/logout')
}

function abrirModalCadastro() {
    isEditing.value = false
    Object.assign(receitaAtual, {
        id: null,
        nome: '',
        modo_preparo: '',
        ingredientes: '',
        tempo_preparo_minutos: null,
        porcoes: null,
    })
    showModal.value = true
}

function abrirModalEdicao(receita:object) {
    isEditing.value = true
    Object.assign(receitaAtual, receita)
    showModal.value = true
}

function fecharModal() {
    showModal.value = false
}

function salvarReceita() {
    if (isEditing.value) {
        router.put(`/receitas/${receitaAtual.id}`, receitaAtual, {
            onSuccess: fecharModal
        })
    } else {
        router.post('/receitas', receitaAtual, {
            onSuccess: fecharModal
        })
    }
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
                <button @click="abrirModalCadastro"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Nova Receita
                </button>
            </div>

            <div v-if="receitas.length === 0" class="text-gray-600">Você ainda não cadastrou nenhuma receita.</div>

            <div v-else class="space-y-4">
                <div v-for="receita in receitas" :key="receita.id" class="bg-white shadow rounded p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ receita.nome }}</h3>
                    <p class="text-gray-600 mb-4">{{ receita.modo_preparo }}</p>
                    <div class="flex space-x-2">
                        <button @click="abrirModalEdicao(receita)" class="text-blue-600 hover:underline">Editar</button>
                        <button @click="excluirReceita(receita.id)"
                            class="text-red-600 hover:underline">Excluir</button>
                        <button @click="imprimirReceita(receita.id)"
                            class="text-green-600 hover:underline">Imprimir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl">
                <h2 class="text-xl font-bold mb-4">{{ isEditing ? 'Editar Receita' : 'Nova Receita' }}</h2>

                <form @submit.prevent="salvarReceita" class="space-y-4">
                    <input v-model="receitaAtual.nome" type="text" placeholder="Nome da receita"
                        class="w-full px-4 py-2 border rounded-md" maxlength="45" required />

                    <textarea v-model="receitaAtual.modo_preparo" placeholder="Modo de preparo"
                        class="w-full px-4 py-2 border rounded-md" rows="3" required></textarea>

                    <textarea v-model="receitaAtual.ingredientes" placeholder="Ingredientes"
                        class="w-full px-4 py-2 border rounded-md" rows="2"></textarea>

                    <div class="flex space-x-4">
                        <input v-model="receitaAtual.tempo_preparo_minutos" type="number" placeholder="Tempo (min)"
                            class="w-full px-4 py-2 border rounded-md" />
                        <input v-model="receitaAtual.porcoes" type="number" placeholder="Porções"
                            class="w-full px-4 py-2 border rounded-md" />
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" @click="fecharModal"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            {{ isEditing ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

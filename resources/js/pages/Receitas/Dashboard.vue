<script setup lang="ts">
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Navbar from '@/components/Navbar.vue'
import ModalReceitas from '@/components/ModalReceitas.vue'
import CardReceitas from '@/components/CardReceitas.vue'

const { auth, receitas, categorias } = defineProps<{
    auth: { user: { nome: string } }
    receitas: {
        id: number
        nome: string
        modo_preparo: string
        ingredientes: string
        tempo_preparo_minutos: number
        porcoes: number
        id_categorias: number | null
        categoria?: { nome: string }
    }[]
    categorias: { id: number; nome: string }[]
}>()

const showModal = ref(false)
const isEditing = ref(false)
const filtro = ref('')

const form = useForm({
    id: null,
    nome: '',
    modo_preparo: '',
    ingredientes: '',
    tempo_preparo_minutos: null,
    porcoes: null,
    id_categorias: null,
})

const receitasFiltradas = computed(() =>
    receitas.filter((r) =>
        `${r.nome} ${r.modo_preparo} ${r.ingredientes}`
            .toLowerCase()
            .includes(filtro.value.toLowerCase())
    )
)

function abrirModalCadastro() {
    isEditing.value = false
    form.reset()
    form.clearErrors()
    showModal.value = true
}

function abrirModalEdicao(receita: any) {
    isEditing.value = true
    form.reset()
    form.clearErrors()

    form.id = receita.id
    form.nome = receita.nome
    form.modo_preparo = receita.modo_preparo
    form.ingredientes = receita.ingredientes
    form.tempo_preparo_minutos = receita.tempo_preparo_minutos
    form.porcoes = receita.porcoes
    form.id_categorias = receita.id_categorias

    showModal.value = true
}

function fecharModal() {
    showModal.value = false
    form.clearErrors()
}

function salvarReceita() {
    if (isEditing.value) {
        form.put(`/receitas/${form.id}`, {
            onSuccess: fecharModal,
        })
    } else {
        form.post('/receitas', {
            onSuccess: fecharModal,
        })
    }
}

function excluirReceita(id: number) {
    if (confirm('Tem certeza que deseja excluir esta receita?')) {
        form.delete(`/receitas/${id}`)
    }
}

function imprimirReceita(id: number) {
    window.open(`/receitas/${id}/imprimir`, '_blank')
}
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <Navbar :auth="auth" />

        <div class="max-w-4xl mx-auto py-10 px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Minhas Receitas</h2>
                <button @click="abrirModalCadastro"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Nova Receita
                </button>
            </div>

            <div class="mb-6">
                <input v-model="filtro" type="text" placeholder="Buscar receita por nome ou preparo..."
                    class="w-full px-4 py-2 border rounded-md" />
            </div>

            <div v-if="receitasFiltradas.length === 0" class="text-gray-600">
                Nenhuma receita encontrada.
            </div>

            <div v-else class="space-y-4">
                <CardReceitas v-for="receita in receitasFiltradas" :key="receita.id" :receita="receita"
                    @editar="abrirModalEdicao" @excluir="excluirReceita" @imprimir="imprimirReceita" />
            </div>
        </div>

        <ModalReceitas :show="showModal" :isEditing="isEditing" :receita="form" :categorias="categorias"
            :errors="form.errors" @fechar="fecharModal" @salvar="salvarReceita" />
    </div>
</template>

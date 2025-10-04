<template>
    <div class="bg-white shadow rounded p-4">
        <h3 class="text-lg font-semibold text-gray-800">{{ receita.nome }}</h3>
        <p class="text-gray-600 mb-1">
            <strong>Categoria:</strong> {{ receita.categoria?.nome || 'Sem categoria' }}
        </p>
        <p class="text-gray-600 mb-4">{{ receita.modo_preparo }}</p>
        <div class="flex space-x-2">
            <button @click="$emit('editar', receita)" class="text-blue-600 hover:underline">Editar</button>
            <button @click="$emit('excluir', receita.id)" class="text-red-600 hover:underline">Excluir</button>
            <button @click="$emit('imprimir', receita.id)" class="text-green-600 hover:underline">Imprimir</button>
        </div>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    receita: {
        id: number
        nome: string
        modo_preparo: string
        ingredientes: string
        tempo_preparo_minutos: number
        porcoes: number
        id_categorias: number | null
        categoria?: { nome: string }
    }
}>()
</script>

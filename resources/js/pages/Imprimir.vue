<script setup lang="ts">
import { defineProps } from 'vue'

defineProps<{
    receita: {
        nome: string
        modo_preparo: string
        ingredientes: string
        tempo_preparo_minutos: number
        porcoes: number
        categoria?: { nome: string }
    }
}>()
</script>

<template>
    <div class="max-w-3xl mx-auto py-10 px-4 print:p-0 print:m-0">
        <h1 class="text-3xl font-bold mb-4">{{ receita.nome }}</h1>

        <p><strong>Categoria:</strong> {{ receita.categoria?.nome || 'Sem categoria' }}</p>
        <p><strong>Tempo de preparo:</strong> {{ receita.tempo_preparo_minutos }} minutos</p>
        <p><strong>Porções:</strong> {{ receita.porcoes }}</p>

        <h2 class="text-xl font-semibold mt-6 mb-2">Ingredientes</h2>
        <p class="whitespace-pre-line">{{ receita.ingredientes }}</p>

        <h2 class="text-xl font-semibold mt-6 mb-2">Modo de Preparo</h2>
        <p class="whitespace-pre-line">{{ receita.modo_preparo }}</p>
    </div>
</template>

<template>
    <div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl">
            <h2 class="text-xl font-bold mb-4">{{ isEditing ? 'Editar Receita' : 'Nova Receita' }}</h2>

            <form @submit.prevent="onSubmit" class="space-y-4">
                <div>
                    <input v-model="receita.nome" type="text" placeholder="Nome da receita"
                        class="w-full px-4 py-2 border rounded-md" maxlength="45" required />
                    <span v-if="errors.nome" class="text-red-500 text-sm">{{ errors.nome }}</span>
                </div>

                <div>
                    <textarea v-model="receita.modo_preparo" placeholder="Modo de preparo"
                        class="w-full px-4 py-2 border rounded-md" rows="3" required></textarea>
                    <span v-if="errors.modo_preparo" class="text-red-500 text-sm">{{ errors.modo_preparo }}</span>
                </div>

                <div>
                    <textarea v-model="receita.ingredientes" placeholder="Ingredientes"
                        class="w-full px-4 py-2 border rounded-md" rows="2"></textarea>
                    <span v-if="errors.ingredientes" class="text-red-500 text-sm">{{ errors.ingredientes }}</span>
                </div>

                <div class="flex space-x-4">
                    <div class="w-full">
                        <input v-model="receita.tempo_preparo_minutos" type="number" placeholder="Tempo (min)"
                            class="w-full px-4 py-2 border rounded-md" />
                        <span v-if="errors.tempo_preparo_minutos" class="text-red-500 text-sm">{{
                            errors.tempo_preparo_minutos }}</span>
                    </div>
                    <div class="w-full">
                        <input v-model="receita.porcoes" type="number" placeholder="Porções"
                            class="w-full px-4 py-2 border rounded-md" />
                        <span v-if="errors.porcoes" class="text-red-500 text-sm">{{ errors.porcoes }}</span>
                    </div>
                </div>

                <div>
                    <select v-model="receita.id_categorias" class="w-full px-4 py-2 border rounded-md">
                        <option :value="null">Sem categoria</option>
                        <option v-for="cat in categorias" :key="cat.id" :value="cat.id">{{ cat.nome }}</option>
                    </select>
                    <span v-if="errors.id_categorias" class="text-red-500 text-sm">{{ errors.id_categorias }}</span>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" @click="$emit('fechar')"
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
</template>

<script setup lang="ts">
const props = defineProps<{
    show: boolean
    isEditing: boolean
    receita: {
        id: number | null
        nome: string
        modo_preparo: string
        ingredientes: string
        tempo_preparo_minutos: number | null
        porcoes: number | null
        id_categorias: number | null
    }
    categorias: { id: number; nome: string }[]
    errors: Record<string, string>
}>()

const emit = defineEmits(['fechar', 'salvar'])

function onSubmit() {
    emit('salvar')
}
</script>

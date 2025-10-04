<template>
    <Navbar />

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Cadastro</h2>

            <form @submit.prevent="cadastrar">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="nome">Nome</label>
                    <input v-model="form.nome"
                        :class="['w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2', form.errors.nome ? 'border-red-500 ring-red-500' : 'border-gray-300 ring-green-500']"
                        maxlength="100" minlength="2" id="nome" type="text" placeholder="Seu Nome" />
                    <p v-if="form.errors.nome" class="text-red-500 text-sm mt-1">{{ form.errors.nome }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="nloginome">Login</label>
                    <input v-model="form.login"
                        :class="['w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2', form.errors.login ? 'border-red-500 ring-red-500' : 'border-gray-300 ring-green-500']"
                        maxlength="100" minlength="2" id="login" type="text" placeholder="Seu Login" />
                    <p v-if="form.errors.login" class="text-red-500 text-sm mt-1">{{ form.errors.login }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="senha">Senha</label>
                    <input v-model="form.password"
                        :class="['w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2', form.errors.password ? 'border-red-500 ring-red-500' : 'border-gray-300 ring-green-500']"
                        maxlength="100" minlength="2" id="senha" type="password" placeholder="********" />
                    <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">Cadastrar</button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Já tem conta? 
                <Link href="/login" class="text-green-600 hover:underline">
                Logar</Link>
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import Navbar from '@/components/Navbar.vue'
import { Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    nome: '',
    login: '',
    password: ''
})

function cadastrar() {
    form.post('/cadastro')
}
</script>
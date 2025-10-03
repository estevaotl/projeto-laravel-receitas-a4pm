<template>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Cadastro</h2>

            <form>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="nome">Nome</label>
                    <input id="nome" type="text" placeholder="Seu nome"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="email">Email</label>
                    <input id="email" type="email" placeholder="seu@email.com"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="senha">Senha</label>
                    <input id="senha" type="password" placeholder="********"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">Cadastrar</button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Já tem conta?
                <Link href="/logar" class="text-green-600 hover:underline">
                </Link>
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

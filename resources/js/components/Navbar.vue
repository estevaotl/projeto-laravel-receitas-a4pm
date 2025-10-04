<template>
    <div>
        <component :is="navbarComponent" v-bind="navbarProps" />
        <main>
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import NavbarUsuario from './NavbarUsuario.vue';
import NavbarVisitante from './NavbarVisitante.vue';

const props = defineProps<{
    auth?: {
        user: {
            nome: string
        }
    }
}>()

const navbarComponent = props.auth ? NavbarUsuario : NavbarVisitante
const navbarProps = props.auth ? { auth: props.auth } : {}
</script>

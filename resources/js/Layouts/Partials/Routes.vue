<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue';
const { url } = usePage()

const isActive = computed(() =>(link) => {
    if( url === link){
        return 'active';
    }
    return '';
})

defineProps({
    compact: {
        type: Boolean,
        default: false
    }
})
</script>
<template>
  <ul class="space-y-2">
    <li>
        <Link :href="route('dashboard')" :class="[isActive('/app/dashboard'), 'flex p-2 ps-5 text-gray-300 rounded [&.active]:shadow dark:text-gray-400 hover:text-white hover:bg-[rgba(255,255,255,.1)] dark:hover:bg-gray-800 dark:hover:text-white [&.active]:text-white [&.active]:dark:text-white [&.active]:bg-primary-600 [&.active]:dark:bg-primary-800 group']">
            <i :class="['icon-[foundation--graph-pie]', isActive('/app/dashboard'), 'w-6 h-6 text-gray-300 dark:text-gray-400 group-hover:text-white [&.active]:text-white [&.active]:dark:text-white']" ></i>
            <span :class="[compact ? 'opacity-0 pointer-events-none' : 'opacity-100', 'absolute left-16 whitespace-nowrap transition-all ease-in duration-300']" >Dashboard</span>
        </Link>
    </li>
    <li>
        <Link :href="route('properties')" :class="[isActive('/app/properties'),'flex p-2 ps-5 text-gray-300 rounded [&.active]:shadow dark:text-gray-400 hover:text-white hover:bg-[rgba(255,255,255,.1)] dark:hover:bg-gray-800 dark:hover:text-white [&.active]:text-white [&.active]:dark:text-white [&.active]:bg-primary-600 [&.active]:dark:bg-primary-800 group']">
            <i :class="['icon-[tabler--building-community]',  isActive('/app/properties'), 'w-6 h-6 text-gray-300 dark:text-gray-400 group-hover:text-white [&.active]:text-white [&.active]:dark:text-white']"></i>
            <span :class="[compact ? 'opacity-0 pointer-events-none' : 'opacity-100', 'absolute left-16 whitespace-nowrap transition-all ease-in duration-300']" >Inmuebles</span>
        </Link>
    </li>
    <li>
        <Link :href="route('users')" :class="[isActive('/app/users'), 'flex p-2 ps-5 text-gray-300 rounded [&.active]:shadow dark:text-gray-400 hover:text-white hover:bg-[rgba(255,255,255,.1)] dark:hover:bg-gray-800 dark:hover:text-white [&.active]:text-white [&.active]:dark:text-white [&.active]:bg-primary-600 [&.active]:dark:bg-primary-800 group']">
            <i :class="['icon-[mdi--users]',  isActive('/app/users'), 'w-6 h-6 text-gray-300 dark:text-gray-400 group-hover:text-white [&.active]:text-white [&.active]:dark:text-white']"></i>
            <span :class="[compact ? 'opacity-0 pointer-events-none' : 'opacity-100', 'absolute left-16 whitespace-nowrap transition-all ease-in duration-300']" >Usuarios</span>
        </Link>
    </li>
</ul>
</template>


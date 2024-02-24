<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
const { url } = usePage()

const dashboardClass = url === '/dashboard' ? 'active' : '';
const usersClass = url === '/users' ? 'active' : '';
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
        <Link :href="route('dashboard')" :class="[dashboardClass, 'flex p-2 ps-5 text-gray-300 rounded [&.active]:shadow dark:text-gray-400 hover:text-white hover:bg-[rgba(255,255,255,.1)] dark:hover:bg-gray-800 dark:hover:text-white [&.active]:text-white [&.active]:dark:text-white [&.active]:bg-primary [&.active]:dark:bg-darkprimary group']">
            <i :class="['icon-[foundation--graph-pie]',  dashboardClass]" class="w-6 h-6 text-gray-300 dark:text-gray-400 group-hover:text-white [&.active]:text-white [&.active]:dark:text-white"></i>
            <span :class="[compact ? 'opacity-0 pointer-events-none' : 'opacity-100', 'absolute left-16 whitespace-nowrap transition-all ease-in duration-300']" >Dashboard</span>
        </Link>
    </li>
    <li>
        <Link :href="route('users')" :class="[usersClass]" class="flex p-2 ps-5 text-gray-300 rounded [&.active]:shadow dark:text-gray-400 hover:text-white hover:bg-[rgba(255,255,255,.1)] dark:hover:bg-gray-800 dark:hover:text-white [&.active]:text-white [&.active]:dark:text-white [&.active]:bg-primary [&.active]:dark:bg-darkprimary group">
            <i :class="['icon-[mdi--users]',  usersClass]" class="w-6 h-6 text-gray-300 dark:text-gray-400 group-hover:text-white [&.active]:text-white [&.active]:dark:text-white"></i>
            <span :class="[compact ? 'opacity-0 pointer-events-none' : 'opacity-100', 'absolute left-16 whitespace-nowrap transition-all ease-in duration-300']" >Usuarios</span>
        </Link>
    </li>
</ul>
</template>


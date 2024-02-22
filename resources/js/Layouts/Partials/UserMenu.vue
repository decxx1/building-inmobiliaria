<template>
  <div class="flex items-center ms-3">
    <div>
        <button type="button" class="flex items-center gap-4" aria-expanded="false" data-dropdown-toggle="dropdown-user">
            <img class="w-10 h-10 rounded-full" :src="$page.props.auth.user.avatar ? $page.props.auth.user.avatar : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'" alt="user photo">
            <div class="font-medium dark:text-white">
                <div>{{ $page.props.auth.user.name }}</div>
            </div>
        </button>
    </div>
    <div class="hidden z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ $page.props.auth.user.name }}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ $page.props.auth.user.email }}
            </p>
        </div>
        <ul class="py-1" role="none">
            <li>
                <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
            </li>
            <li>
                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                    Log Out
                </ResponsiveNavLink>
            </li>
        </ul>
    </div>
</div>
</template>

<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>

<style>

</style>

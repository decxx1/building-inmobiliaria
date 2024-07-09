<script setup>
import {
    whatsappLinkeable,
} from '@/Services/env.js';
</script>

<template>
    <a class="float-button flex" target="_blank" :href="'https://wa.me/54' + whatsappLinkeable">
        <i class="icon-[mdi--whatsapp] mr-2 w-5 h-5 lg:w-6 lg:h-6"></i>
        <span class="font-semibold">Consultas</span>
    </a>
</template>

<style scoped>
/*whatsapp button*/

.float-button {
	text-decoration: none;
    position: fixed;
	padding: 10px;
	padding-right: 15px;
	bottom: 30px;
	right: 30px;
	color: #fff;
	background-color:#25D366;
	border-radius: 25px 30px 5px 25px;
	z-index: 100;
	font-family: Arial;
	font-size: 17px;
	animation: whatsapp-animation 0.5s ease-in-out;
	box-shadow: 1px 2px 5px 2px rgba(30,30,30,0.3);
	transition:all 0.3s ease-out;
}

.float-button:hover {
	background-color: #128C7E;
	color: #fff;
    text-decoration: none;
}

.whbutton {
	font-size: 22px !important;
	padding-right: 5px;
	padding-left: 5px;
}

@keyframes whatsapp-animation {
	from {
		opacity: 0%;
	}

	to {
		opacity: 100%
	}
}

@media screen and (max-width: 545px) {
	span {
		display: none;
	}

	.float-button {
		bottom: 15px;
		right: 15px;
		border-radius: 20px 20px 5px 20px;
	}
	.whbutton {
		font-size: 32px !important;
	}
}
</style>

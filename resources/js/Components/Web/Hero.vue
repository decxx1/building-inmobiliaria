<template>
    <section
        class="bg-[url('/images/hero.avif')] bg-no-repeat bg-cover bg-center bg-gray-100 bg-blend-multiply dark:bg-gray-400">
        <div class="relative py-8 px-4 mx-auto max-w-screen-xl lg:py-52 xl:px-0 z-1">
            <div class="max-w-md text-center mx-auto min-h-96 justify-center flex">
                <div class="bg-white p-4 dark:bg-gray-800 rounded bottom-24 lg:bottom-64 absolute">
                    <form class="mx-auto grid gap-4 grid-cols-12">
                        <select id="operacion" class="col-span-6 sm:col-span-2 max-sm:mb-2 p-2 h-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-700 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500">
                            <option value="venta" selected>Venta</option>
                            <option value="alquiler">Alquiler</option>
                            <option value="temporario">Alquiler temporario</option>
                            <option value="permuta">Permuta</option>
                        </select>
                        <select id="propiedad" class="col-span-6 sm:col-span-3 max-sm:mb-2 p-2 h-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-700 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500">
                            <option value="casas">Casas</option>
                            <option value="departamentos">Departamentos</option>
                            <option value="lotesYTerrenos">Lotes y terrenos</option>
                            <option value="localesComerciales">Locales comerciales</option>
                            <option value="cocherasYPlayasDeEst">Cocheras y playas de est.</option>
                            <option value="bodegasYFincas">Bodegas y fincas</option>
                            <option value="industriasYFabricas">Industrias y fábricas</option>
                            <option value="edificios">Edificios</option>
                            <option value="galponesYDepositos">Galpones y depósitos</option>
                            <option value="camposYVinedos">Campos y viñedos</option>
                            <option value="negociosYFondosDeComercio">Negocios y fondos de comercio</option>
                            <option value="oficinas">Oficinas</option>
                            <option value="cabanas">Cabañas</option>
                        </select>
                        <div class="col-span-12 sm:col-span-5 relative max-sm:mb-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-web-500 focus:border-primary-web-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500" placeholder="Ingrese ubicación" />
                        </div>
                        <button type="button" class="col-span-12 sm:col-span-2 text-white bg-primary-web-700 hover:bg-primary-web-800 focus:ring-4 focus:ring-primary-web-300 font-medium text-sm py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

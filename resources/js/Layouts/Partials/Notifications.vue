<template>
  <!-- Notifications -->
  <button
					type="button"
					data-dropdown-toggle="notification-dropdown"
					class="p-2 text-gray-400 rounded-lg hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-background-dark"
				>
					<span class="sr-only">View notifications</span>
					<!-- Bell icon -->
					<svg
						class="w-6 h-6"
						fill="currentColor"
						viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg"
						><path
							d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
						></path></svg
					>
				</button>
				<!-- Dropdown menu -->
				<div
					class="z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-surface-dark dark:bg-background-dark"
					id="notification-dropdown"
				>
					<div
						class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-background-dark dark:text-white"
					>
						Notificaciones
					</div>
					<div>
						<!-- <a
							href="#"
							class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-surface-dark dark:border-surface-dark"
						>
							<div class="flex-shrink-0">
								<img
									class="rounded-full w-11 h-11"
									src="images/users/bonnie-green.png"
									alt="Jese image"
								/>
								<div
									class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 border border-white rounded-full bg-primary-700 dark:border-gray-700"
								>
									<svg
										class="w-3 h-3 text-white"
										fill="currentColor"
										viewBox="0 0 20 20"
										xmlns="http://www.w3.org/2000/svg"
										><path
											d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"
										></path><path
											d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"
										></path></svg
									>
								</div>
							</div>
							<div class="w-full pl-3">
								<div
									class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"
								>
									New message from <span
										class="font-semibold text-gray-900 dark:text-white"
										>Bonnie Green</span
									>: "Hey, what's up? All set for the presentation?"
								</div>
								<div
									class="text-xs font-medium text-primary-700 dark:text-primary-400"
								>
									a few moments ago
								</div>
							</div>
						</a> -->


                        <div role="status" class="max-w-sm p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-surface-dark">
                            <div class="flex items-center mt-4">
                                <svg class="w-10 h-10 me-3 text-gray-200 dark:text-surface-dark" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                </svg>
                                <div>
                                    <div class="h-2.5 bg-gray-200 rounded-full dark:bg-surface-dark w-32 mb-2"></div>
                                    <div class="w-48 h-2 bg-gray-200 rounded-full dark:bg-surface-dark"></div>
                                </div>
                            </div>
                            <span class="sr-only">Loading...</span>
                        </div>



					</div>
					<a
						href="#"
						class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-background-dark dark:text-white dark:hover:underline"
					>
						<div class="inline-flex items-center">
							<svg
								class="w-5 h-5 mr-2"
								fill="currentColor"
								viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg"
								><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path
									fill-rule="evenodd"
									d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
									clip-rule="evenodd"></path></svg
							>
							Ver Todas
						</div>
					</a>
				</div>
</template>

<script>
export default {

}
</script>

<style>

</style>

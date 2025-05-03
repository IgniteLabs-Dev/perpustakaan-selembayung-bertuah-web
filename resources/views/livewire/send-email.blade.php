<div class="div">
    <div class="px-2  " x-show="open">
        <div class="px-3 p-4 bg-slate-200 rounded-xl">
            <div class="flex justify-center">

                <img src="{{ asset('images/email-icon.webp') }}" class="h-20" alt="">
            </div>
            <p class="text-sm  font-semibold text-center">Kirim Email Pengingat Deadline</p>
            <p class="text-center text-xs mb-1">Kirim email pengingat kepada peminjam yang akan berakhir
                1
                hari
                lagi.
            </p>
            <button data-modal-target="modal-confirmation-email" data-modal-toggle="modal-confirmation-email"
                class="w-full  bg-[var(--primary)]  text-white rounded-lg  cursor-pointer px-1.5 py-2">Kirim
                Email
                Peringatan</button>
        </div>
    </div>


    <!-- Main modal -->
    <div id="modal-confirmation-email" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        Kirim Email Pengingat Deadline
                    </h3>
                    <button type="button"
                        class="text-gray-400 cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center  "
                        data-modal-hide="modal-confirmation-email">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-1">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/email-icon.webp') }}" class="h-20" alt="">
                    </div>
                    <p class="text-base  text-center leading-relaxed text-gray-900 ">
                        Apakah Anda yakin ingin mengirimkan email pengingat kepada peminjam yang masa peminjamannya
                        tinggal 1 hari?
                    </p>

                </div>
                <!-- Modal footer -->

                <div class="border-t border-gray-200 rounded-b">
                    <div wire:loading.attr="hidden">

                        <div class="flex items-center justify-center px-4 py-3    ">
                            <button data-modal-hide="default-modal" wire:click="sendEmail" wire:loading.attr="hidden"
                                wire:target="sendEmail" type="button"
                                class="text-white cursor-pointer bg-[var(--primary)] hover:brightness-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-gray-700">
                                <span wire:loading.remove wire:target="sendEmail">Kirim Email</span>
                                <span wire:loading wire:target="sendEmail">Mengirim...</span>
                            </button>
                            <button data-modal-hide="modal-confirmation-email" type="button"
                                class="py-2.5 px-5 ms-3 cursor-pointer text-sm font-medium  focus:outline-none bg-red-600 text-white rounded-lg border border-gray-200 hover:brightness-90  focus:z-10 focus:ring-4 focus:ring-gray-100    ">Batal</button>
                        </div>
                    </div>
                    <div class="w-full flex  justify-center">
                        <span wire:loading class="email-loader  my-3"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

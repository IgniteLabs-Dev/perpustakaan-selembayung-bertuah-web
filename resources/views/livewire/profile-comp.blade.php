<div>
    @section('title', 'Profile')
    <div class="max-w-screen-xl  justify-center mx-auto pt-25 flex">
        <div
            class="flex justify-center border-0   md:border-1 border-gray-300 bg-white rounded-xl shadow-sm py-10  flex-col font-semibold  ">
            <h3 class="text-center font-bold text-2xl mb-5">Profile Settings</h3>
            <div class="w-full flex flex-col md:flex-row justify-center items-start">

                <div class="md:w-2/5 w-full flex justify-center flex-wrap md:flex-col ">
                    <div class="w-full  justify-center flex">
                        @if ($image_baru == null)
                            @if ($user->cover == null || !file_exists(public_path('images/profile/' . $user->cover)))
                                <img class="rounded-4xl mb-3  h-70 w-70  object-cover aspect-square"
                                    src="{{ asset('images/profile/profile-blank.png') }}" alt="">
                            @else
                                <img class="rounded-4xl mb-3  h-70 w-70  object-cover aspect-square"
                                    src="{{ asset('images/profile/' . $user->cover) }}" alt="">
                            @endif
                        @else
                            <img class=" rounded-4xl mb-3  h-70 w-70  object-cover aspect-square"
                                src="{{ $image_baru->temporaryUrl() }}">
                        @endif
                    </div>
                    @if ($editMode != null)
                        <div class="w-full  justify-center flex">
                            <div class=" w-70 ">

                                <label class="text-sm text-gray-500 ">Cover<span class="text-gray-40 text-[10px]"> (PNG,
                                        JPG
                                        or JPEG (MAX.
                                        1MB))</span></label>
                                <input wire:model.defer="image_baru"
                                    class="p-1 w-full cursor-pointer text-slate-500 text-sm rounded-full leading-6 file:bg-[var(--primary)]  file:text-white file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:cursor-pointer file:rounded-full hover:file:brightness-90 border border-gray-300 "
                                    aria-describedby="file_input_help" id="file_input" type="file">

                                <div class="text-red-500 font-italic text-sm" wire:loading wire:target="image_baru">
                                    Uploading...
                                </div>

                                @error('image_baru')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                    @endif

                </div>
                <div class="md:w-2/5 w-full flex justify-start ps-4 pe-4 flex-col">

                    <div class="w-full items-start">
                        <x-input :attribute="$editMode ? '' : 'readonly'" symbol="*" typeWire="defer" inputId="name" label="Nama"
                            type="text" wireModel="name" placeholder="Masukkan Nama" />
                    </div>
                    <div class="w-full items-start">
                        <x-input :attribute="$editMode ? '' : 'readonly'" symbol="*" typeWire="defer" inputId="email" label="Email"
                            type="email" wireModel="email" placeholder="Masukkan Email" />
                    </div>
                    <div class="w-full items-start">
                        <x-input :attribute="$editMode ? '' : 'readonly'" symbol="*" typeWire="defer" inputId="tanggal_lahir"
                            label="Tanggal Lahir" type="date" wireModel="tanggal_lahir"
                            placeholder="Masukkan Tanggal Lahir" />
                    </div>
                    <div class="w-full items-start">
                        <x-input :attribute="$editMode ? '' : 'readonly'" symbol="*" typeWire="defer" inputId="nis" label="NIS"
                            type="text" wireModel="nis" placeholder="Masukkan NIS" />
                    </div>
                    @if ($editMode != null)
                        <div class="w-full items-start">
                            <x-input :attribute="$editMode ? '' : 'readonly'" symbol="‎" typeWire="defer" inputId="password"
                                label="Password" type="password" wireModel="password" placeholder="Masukkan Password" />
                        </div>
                    @endif
                    <div class="w-full flex">
                        <div class="w-1/2 items-start pe-1.5">
                            <x-input :attribute="$editMode ? '' : 'readonly'" symbol="*" typeWire="defer" inputId="kelas" label="Kelas"
                                type="number" wireModel="kelas" placeholder="Masukkan Kelas" />
                        </div>
                        <div class="w-1/2 items-start ps-1.5">
                            <x-input :attribute="$editMode ? '' : 'readonly'" symbol="*" typeWire="defer" inputId="semester"
                                label="Semester" type="number" wireModel="semester" placeholder="Masukkan Semester" />
                        </div>
                    </div>
                    <div class="flex">
                        @if ($editMode == null)
                            <button
                                class="w-full mt-3 bg-[var(--primary)] hover:brightness-90 text-white font-bold py-2 px-4 rounded-lg cursor-pointer focus:outline-none focus:shadow-outline"
                                wire:click="$set('editMode', true)">
                                Edit Profile
                            </button>
                        @else
                            <div class="flex w-full">

                                <div class="w-1/2 pe-1.5">

                                    <button
                                        class="w-full mt-3 bg-red-500 hover:brightness-90 text-white font-bold py-2 px-4 rounded-lg cursor-pointer focus:outline-none focus:shadow-outline"
                                        wire:click="$set('editMode', '')">
                                        Batal
                                    </button>
                                </div>
                                <div class="w-1/2 ps-1.5">

                                    <button
                                        class="w-full mt-3 bg-[var(--primary)] hover:brightness-90 text-white font-bold py-2 px-4 rounded-lg cursor-pointer focus:outline-none focus:shadow-outline"
                                        wire:click="updateProfile"> Simpan </button>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>

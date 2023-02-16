<x-app-layout>
    <x-slot name="header">
        {{ __('Files') }}: {{ $path }}
    </x-slot>

    <div class="mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <h4 class="mb-4 text-xl font-medium text-gray-700">Upload File</h4>

            <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-input-label for="path" :value="__('Path')"/>
                        <x-text-input type="text"
                                name="path"
                                id="path"
                                value="{{ old('path', $path) }}"
                                required
                        />
                        <x-input-error :messages="$errors->get('path')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="file" :value="__('File')"/>

                        <input type="file" name="file" class="mt-2 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100
                            "/>

                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                </div>

                <div class="flex flex-col items-end mt-4">
                    <x-primary-button class="w-full">
                        {{ __('Upload') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Name
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Size
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($path != '/')
                <tr>
                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                        <p class="italic whitespace-no-wrap">
                            <a href="{{ route('files.index', [$parentPath]) }}">{{ '.. up a level' }}</a>
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                    </td>
                </tr>
                @endif

                @foreach ($directories as $directory)
                <tr>
                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                        <p class="font-bold whitespace-no-wrap">
                            <a href="{{ $directory['link'] }}">{{ $directory['name'] }}</a>
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                    </td>
                </tr>
                @endforeach

                @foreach ($files as $file)
                <tr>
                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $file['name'] }}</p>
                    </td>
                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $file['size'] }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>

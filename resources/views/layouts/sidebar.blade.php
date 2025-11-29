<div class="w-[200px] inline-flex flex-col bg-white text-black h-screen sticky top-0 border-r border-gray-300">
    <h2 class="text-xl font-bold mb-4 text-center pt-[20px]">NAVIGATION</h2>

    <ul class="flex-grow">

        {{-- Borrowings --}}
        <li>
            <a href="{{ route('borrowings.index') }}"
                class="flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-200">

                <div
                    class="w-[5px] h-[15px] 
                    {{ request()->routeIs('borrowings.index') ? 'bg-green-500' : 'bg-gray-300' }}">
                </div>

                <span class="text-[17px] font-medium">Borrowings</span>
            </a>
        </li>

        {{-- Books --}}
        <li>
            <a href="{{ route('books.index') }}"
                class="flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-200">

                <div
                    class="w-[5px] h-[15px] 
                    {{ request()->routeIs('books.index') ? 'bg-green-500' : 'bg-gray-300' }}">
                </div>

                <span class="text-[17px] font-medium">Books</span>
            </a>
        </li>

        {{-- Fines --}}
        <li>
            <a href="{{ route('fines.index') }}"
                class="flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-200">

                <div
                    class="w-[5px] h-[15px] 
                    {{ request()->routeIs('fines.index') ? 'bg-green-500' : 'bg-gray-300' }}">
                </div>

                <span class="text-[17px] font-medium">Fines</span>
            </a>
        </li>

        {{-- Members --}}
        <li>
            <a href="{{ route('members.index') }}" class="flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-200">

                <div
                    class="w-[5px] h-[15px]
                    {{ request()->routeIs('members.index') ? 'bg-green-500' : 'bg-gray-300' }}">
                </div>

                <span class="text-[17px] font-medium">Members</span>
            </a>
        </li>

        {{-- Staffs --}}
        <li>
            <a href="{{ route('staffs.index') }}" class="flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-200">

                <div class="w-[5px] h-[15px] bg-gray-300"></div>

                <span class="text-[17px] font-medium">Staffs</span>
            </a>
        </li>

    </ul>
    <a href="{{ route('logout') }}" class="flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-200">

        <span class="text-[17px] font-medium text-red-400">Logout</span>
    </a>
</div>

<div class="w-[200px] inline-flex flex-col bg-white text-black h-screen sticky top-0">
    <h2 class="text-xl font-bold mb-4 text-center pt-[20px] tracking-widest">NAVIGATION</h2>
    {{-- YoRHa User Block --}}
    <div class="px-[20px] mb-6 mt-2">

        <div class="border border-gray-300 p-3 relative bg-white">

            <!-- Top-left accent line -->
            <div class="absolute -top-[1px] -left-[1px] w-[25px] h-[2px] bg-black"></div>
            <div class="absolute -top-[1px] -left-[1px] w-[2px] h-[25px] bg-black"></div>

            <!-- User Name -->
            <div class="text-[15px] font-semibold tracking-widest text-gray-800">
                {{ Auth::user()->name }}
            </div>

            <!-- Rank / Role (optional) -->
            <div class="text-[12px] uppercase tracking-widest text-gray-500 mt-[2px]">
                {{ Auth::user()->role->name ?? 'OPERATOR' }}
            </div>

            <!-- Subtle separator -->
            <div class="mt-3 h-[1px] bg-gray-300/70"></div>

            <!-- ID style line -->
            <div class="mt-2 text-[11px] tracking-wide text-gray-500">
                ID: {{ Auth::user()->id }}
            </div>
        </div>
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

    {{-- YoRHa Logout --}}
    <a href="{{ route('logout') }}"
        class="group flex items-center gap-[10px] px-[20px] py-[15px] hover:bg-gray-100 
               transition-all duration-200 relative">

        <svg class="w-5 h-5 text-red-500 group-hover:text-black transition-all duration-200" fill="none"
            stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
        </svg>

        <span
            class="text-[17px] font-medium tracking-widest text-red-500 
                     group-hover:text-black transition-all duration-200">
            LOGOUT
        </span>

        <span
            class="absolute bottom-3 left-[20px] right-[20px] h-[1px] bg-black/40
                     scale-x-0 group-hover:scale-x-100 origin-left 
                     transition-transform duration-300"></span>
    </a>
</div>

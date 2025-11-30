<li>
    <a href="{{ route($route) }}"
       class="group relative flex items-center gap-[10px] px-[20px] py-[15px]
              transition-all duration-200
              {{ $isActive() ? 'bg-black text-white' : 'hover:bg-gray-100 text-gray-700' }}">

        <!-- Accent Bar -->
        <div class="w-[4px] h-full 
            {{ $isActive() ? 'bg-white' : 'bg-gray-300' }}
            group-hover:bg-black transition-all duration-200">
        </div>

        <!-- Text -->
        <span class="text-[16px] font-medium tracking-widest
            {{ $isActive() ? 'text-white' : 'text-gray-700 group-hover:text-black' }}">
            {{ $label }}
        </span>

        <!-- Hover Line Under Link -->
        <span class="absolute bottom-3 left-[20px] right-[20px] h-[1px] bg-black/40
                     scale-x-0 group-hover:scale-x-100 origin-left 
                     transition-all duration-300">
        </span>

    </a>
</li>

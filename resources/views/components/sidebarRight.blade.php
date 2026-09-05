<div id="{{ $id }}" tabindex="-1" 
   class="border border-slate-300 fixed inset-y-0 left-0 z-50 hidden w-full max-w-[300px] md:max-w-[750px] lg:max-w-[1000px] flex flex-col bg-white shadow-xl dark:bg-gray-600 transform transition-transform -translate-x-full"
    aria-hidden="true">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
        <h3 class="text-lg md:text-xl font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
        <button type="button" 
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
            data-sidebar-hide="{{ $id }}">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close sidebar</span>
        </button>
    </div>

    <!-- Sidebar Content -->
    <div class="p-4 md:p-5 overflow-y-auto flex-grow">
        {{ $slot }}
    </div>
</div>

<script>
    // Close Sidebar
    document.querySelectorAll('[data-sidebar-hide]').forEach(button => {
        button.addEventListener('click', function () {
            const sidebarId = this.getAttribute('data-sidebar-hide');
            const sidebar = document.getElementById(sidebarId);
            if (sidebar) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('hidden');
            }
        });
    });

    // Open Sidebar
    function openSidebar(id) {
        const sidebar = document.getElementById(id);
        if (sidebar) {
            sidebar.classList.remove('hidden');  // Make the sidebar visible
            sidebar.classList.remove('-translate-x-full');  // Slide in
            sidebar.classList.add('translate-x-0');  // Slide in animation
        }
    }
</script>

<style>
    [id^="sidebar-"] {
        transition: transform 0.3s ease-in-out;
    }
</style>

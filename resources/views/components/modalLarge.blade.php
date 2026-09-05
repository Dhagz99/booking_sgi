<div id="{{ $id }}" tabindex="-1" 
    class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-y-auto bg-transparent bg-opacity-0 backdrop-brightness-100">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <!-- Modal container -->
    <div class="relative w-full max-w-3xl max-h-screen overflow-y-auto animate-slide-down">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-xl dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
                <button type="button" 
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-hide="{{ $id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                {{ $slot }}
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end gap-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                @if (isset($primaryButtonText) && isset($primaryButtonAction))
                <button data-modal-hide="{{ $id }}" type="submit" 
                    class="{{ $primaryButtonClass ?? 'text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center' }}"
                    onclick="{{ $primaryButtonAction }}">{{ $primaryButtonText }}</button>
                @endif
                @if (isset($secondaryButtonText) && isset($secondaryButtonAction))
                    <button data-modal-hide="{{ $id }}" type="button" 
                       class="{{ $secondaryButtonClass}}"
                        onclick="{{ $secondaryButtonAction }}">{{ $secondaryButtonText }}</button>
                @endif
            </div>
        </div>
    </div>
    
</div>


<script>
// Function to show modal
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {  // Check if the modal exists
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        console.error(`Modal with ID ${modalId} not found.`);
    }
}

// Function to hide modal
function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {  // Check if the modal exists
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    } else {
        console.error(`Modal with ID ${modalId} not found.`);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Handle buttons that hide modals
    document.querySelectorAll('[data-modal-hide]').forEach((button) => {
        button.addEventListener('click', function () {
            const modalId = button.getAttribute('data-modal-hide');
            hideModal(modalId);
        });
    });

    // Handle buttons that show modals (including nested modals)
    document.querySelectorAll('[data-modal-show]').forEach((button) => {
        button.addEventListener('click', function () {
            const modalId = button.getAttribute('data-modal-show');
            showModal(modalId);
        });
    });

    // Handle parent modal form submission prevention
    const parentForm = document.querySelector('#parent-modal form');
    if (parentForm) {
        parentForm.addEventListener('submit', function (event) {
            // If the nested modal is visible, prevent form submission
            const nestedModal = document.getElementById('nested-modal-id');
            if (nestedModal && nestedModal.classList.contains('flex')) {
                event.preventDefault();  // Prevent form submission
                console.log('Parent form submission prevented because nested modal is open');
            }
        });
    }

    // Handle nested modal form submission
    const nestedForm = document.querySelector('#nested-modal-id form');
    if (nestedForm) {
        nestedForm.addEventListener('submit', function (event) {
            event.preventDefault();  // Prevent the nested modal from affecting parent
            console.log('Nested modal form submitted');
            // Optionally close the nested modal after submission
            hideModal('nested-modal-id');
        });
    }

    // Handle close button for nested modal
    const closeNestedModalBtn = document.querySelector('[data-modal-hide="nested-modal-id"]');
    if (closeNestedModalBtn) {
        closeNestedModalBtn.addEventListener('click', function () {
            hideModal('nested-modal-id');
        });
    }
});

</script>

@extends('base')
@section('title', 'ROOM PAGE')
@section('content')

<div class="p-4">


    <div class="p-2">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg active:text-blue-600 active:border-blue-500"
                        id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="true">Profile</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active:text-blue-600 active:border-blue-500"
                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                        aria-selected="false">Dashboard</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active:text-blue-600 active:border-blue-500"
                        id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                        aria-selected="false">Settings</button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active:text-blue-600 active:border-blue-500"
                        id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts"
                        aria-selected="false">Contacts</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>.</p>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">



                <p>hotdog</p>




              
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.</p>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll("[role='tab']");
            const tabPanels = document.querySelectorAll("[role='tabpanel']");
    
            tabs.forEach(tab => {
                tab.addEventListener("click", function () {
                    // Remove active state from all tabs and hide all panels
                    tabs.forEach(t => {
                        t.classList.remove("text-blue-600", "border-blue-500");
                        t.classList.add("border-transparent");
                    });
                    tabPanels.forEach(panel => panel.classList.add("hidden"));
    
                    // Set active state on the clicked tab and display the associated panel
                    this.classList.remove("border-transparent");
                    this.classList.add("text-blue-600", "border-blue-500");
                    const targetPanel = document.querySelector(this.dataset.tabsTarget);
                    targetPanel.classList.remove("hidden");
                });
            });
        });
    </script>
    
    
    
</div>

@endsection



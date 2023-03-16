<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Open main menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-if="!open" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </DisclosureButton>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">

                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <router-link v-for="item in navigation" :key="item.name" :to="item.to" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']" >{{ item.name }}</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <router-link v-for="item in navigation" :key="item.name" :to="item.to"  :class="[ 'block px-3 py-2 rounded-md text-base font-medium']">{{ item.name }}</router-link>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

const navigation = [
    { name: 'Dashboard', to: 'quiz', routeName:'quiz'  },
    { name: 'Statistics', to: "statistics", routeName: 'statistics' },
]

export default {
    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
    },
    setup() {
        return {
            navigation,
        }
    },
}
</script>

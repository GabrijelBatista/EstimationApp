<template>
<div class="overflow-x-auto">
<div class="min-w-screen min-h-scree flex justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        <div class="bg-white shadow-md rounded-lg my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <div class="p-3 bg-gray-500 text-white uppercase text-xl leading-normal">Project Name</div>
                </tr>
                </thead>
                <thead>
                <tr>
                    <div class="p-3 bg-gray-300 text-gray-600 uppercase text-lg leading-normal"><div class="inline-block float-left w-6">1.</div><div class="inline-block">Module Name</div></div>
                    <div class="p-3 bg-gray-300 text-white uppercase text-xl leading-normal"><input type="text" required class="text-center appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Module Name" /></div>
                </tr>
                </thead>
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No.</th>
                    <th class="py-3 px-6 text-left">Task</th>
                    <th class="py-3 px-6 text-center">Best Case</th>
                    <th class="py-3 px-6 text-center">Average</th>
                    <th class="py-3 px-6 text-center">Worst case</th>
                    <th class="py-3 px-6 text-center"></th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">1.1.</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>Task name</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="font-bold flex items-center text-green-600 justify-center">
                            20h
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex font-bold text-blue-600 items-center justify-center">
                            30h
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex font-bold text-red-600 items-center justify-center">
                            40h
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform text-red-500 hover:text-red-700 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap w-16">
                        <div class="flex w-16 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex  items-center">
                            <input type="text" required class=" appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Task" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex w-36 mx-auto items-center">
                            <input type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="h" />:
                            <input type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex  mx-auto w-36 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex mx-auto w-36 items-center">
                            <input type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="h" />:
                            <input type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform text-green-500 hover:text-green-700 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'

export default{
    data(){
        return {
            module: {
                name: null,
                task: {
                    name: null,
                    best_case: {
                        hours: null,
                        minutes: null
                    },
                    worst_case: {
                        hours: null,
                        minutes: null
                    }
                }
            }
        }
    },
    computed:{
        ...mapGetters([
            'getCurrentProject',
        ])
    }
}
</script>

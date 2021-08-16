<template>
<div id="pdf" class="overflow-x-auto" ref="content">
    <button v-if="!pdf" @click="save_pdf(pdf=true)" class="absolute top-30 right-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
    </button>
<div class="min-w-screen min-h-scree flex justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
            <div class="flex m-auto w-max">
                <div v-if="this.getUser" class="p-5 font-extrabold uppercase text-3xl leading-normal">{{ this.getCurrentProject.name }}
                    <svg @click="project_name_modal=true" v-if="this.getCurrentProject.author.id===this.getUser.id && !pdf" xmlns="http://www.w3.org/2000/svg" class="inline-block cursor-pointer text-yellow-500 transform hover:scale-110 hover:text-yellow-700 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <svg v-if="this.getUser.id===this.getCurrentProject.author.id && !pdf" @click="delete_project_modal=true" class="w-6 inline-block transform cursor-pointer text-red-500 hover:text-red-700 hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>
        <div v-if="this.getUser" @dblclick="edit_module(value.id)" class="flex flex-col" v-for="(value, index) in this.getCurrentProject.modules" :key="value.id">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-3 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow bg-dark overflow-hidden border-b border-gray-200 rounded-2xl">
            <div class="mt-4">
            <div class="min-w-max relative w-full">
                <div class="pb-3 font-bold text-white uppercase text-lg leading-normal">
                    <div class="absolute left-4 w-6">
                        {{ index+1 }}.
                    </div>
                    <div class="inline-block">
                        {{ value.name }}
                    </div>
                    <div v-if="this.getUser.id===this.getCurrentProject.assigned_id && !pdf" @click="delete_module_modal=true; delete_module_id=value.id" class="w-6 absolute right-4 inline-block transform cursor-pointer text-red-500 hover:text-red-700 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
            </div>
            <table class="min-w-max w-full">
                <thead class="bg-gray-800">
                <tr class="text-white text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No.</th>
                    <th class="py-3 px-6 text-left">TASK</th>
                    <th class="py-3 px-6 text-green-600 text-center">BEST CASE</th>
                    <th class="py-3 px-6 text-blue-600 text-center">AVERAGE</th>
                    <th class="py-3 px-6 text-red-600 text-center">WORST CASE</th>
                    <th class="py-3 px-6 text-center"></th>
                </tr>
                </thead>
                <tbody class="text-white text-sm font-light">
                <tr v-if="value.tasks[0]" v-for="(value2, index2) in value.tasks" :key="value2.id" class="border-b border-gray-200">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{index+1}}.{{index2+1}}.</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 w-80 text-left">
                        <div class="flex items-center">
                            <span>{{ value2.name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="font-bold flex items-center text-green-600 justify-center">
                            {{value2.best_hours}}h {{value2.best_minutes}}m
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex font-bold text-blue-600 items-center justify-center">
                            {{value2.average_hours}}h {{value2.average_minutes}}m
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex font-bold text-red-600 items-center justify-center">
                            {{value2.worst_hours}}h {{value2.worst_minutes}}m
                        </div>
                    </td>
                    <td v-if="this.getCurrentProject.assigned_id===this.getUser.id && !pdf" class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div @click="delete_task_modal=true; delete_task_id=value2.id" class="w-4 mr-2 transform cursor-pointer text-red-500 hover:text-red-700 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-if="edit==value.id && !pdf" class="border-2 border-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap w-16">
                        <div class="flex w-16 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex  items-center">
                            <input id="task_name" v-on:keyup.enter="nextPlease(value.id)" v-model="task.name" type="text" required class=" appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Task" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex w-36 mx-auto items-center">
                            <input id="task_best_hours" v-on:keyup.enter="nextPlease(value.id)" v-model="task.best_case.hours" type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="h" />:
                            <input id="task_best_minutes" v-on:keyup.enter="nextPlease(value.id)" v-model="task.best_case.minutes" type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex  mx-auto w-36 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex mx-auto w-36 items-center">
                            <input id="task_worst_hours" v-on:keyup.enter="nextPlease(value.id)" v-model="task.worst_case.hours" type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="h" />
                            <input id="task_worst_minutes" v-on:keyup.enter="nextPlease(value.id)" v-model="task.worst_case.minutes" type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform text-green-500 hover:text-green-700 hover:scale-110">
                                <svg v-on:dblclick.stop @click="nextPlease(value.id)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                <thead class="bg-gray-800">
                <tr class="text-white text-sm leading-normal">
                    <th class="py-3 px-6 text-left"></th>
                    <th class="py-3 px-6 text-left">TOTAL</th>
                    <th class="py-3 px-6 text-green-600 text-center">{{ value.best_hours }}h {{ value.best_minutes }}m</th>
                    <th class="py-3 px-6 text-blue-600 text-center">{{ value.average_hours }}h {{ value.average_minutes }}m</th>
                    <th class="py-3 px-6 text-red-600 text-center">{{ value.worst_hours }}h {{ value.worst_minutes }}m</th>
                    <th class="py-3 px-6 text-center"></th>
                </tr>
                </thead>
            </table>
        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div v-if="project_name_modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <div class="font-extrabold mx-auto text-2xl mb-4">CHANGE PROJECT NAME</div>
            <input v-on:keyup.enter="edit_project_name" v-model="project_name" type="text" required class="text-center mx-auto appearance-none rounded-none relative block w-full py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" :placeholder="this.getCurrentProject.name" />
            <div class="mx-auto block">
                <div @click="project_name_modal=false" class="inline-block bg-gray-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Close</span>
                </div>
                <div @click="edit_project_name" class="inline-block bg-indigo-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
    <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <div class="font-extrabold mx-auto text-2xl mb-4">CREATE NEW MODULE</div>
            <input v-on:keyup.enter="add_module" v-model="module.name" type="text" required class="text-center mx-auto appearance-none rounded-none relative block w-full py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Module Name" />
            <div class="mx-auto block">
                <div @click="modal=false" class="inline-block bg-gray-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Close</span>
                </div>
                <div @click="add_module" class="inline-block bg-indigo-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
    <div v-if="this.getUser" class="flex m-auto w-max">
        <div @click="modal=true" v-if="this.getUser.id===this.getCurrentProject.author.id && !pdf" class="px-5 py-3 mt-4 cursor-pointer bg-green-300 hover:bg-green-400 rounded-2xl border-2 font-extrabold uppercase text-xl leading-normal">Create Module</div>
    </div>
    <div v-if="this.getUser">
        <div v-if="this.getUser.id===this.getCurrentProject.author.id && !pdf" class="flex cursor-pointer justify-between items-center p-2 md:float-right md:mr-5" @click="change_public(!this.getCurrentProject.private_public)">
            <div class="w-32 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-indigo-400': this.getCurrentProject.private_public}">
                <div class="bg-white w-20 h-10 rounded-full shadow-md text-sm font-bold transform duration-300 ease-in-out" :class="{ 'translate-x-12': this.getCurrentProject.private_public,}"><div class="p-2" v-if="!this.getCurrentProject.private_public">PRIVATE</div><div class="p-2" v-if="this.getCurrentProject.private_public">PUBLIC</div></div>
            </div>
        </div>
    </div>
    <div v-if="this.getUser">
        <div v-if="this.getUser.role_id===3 && !pdf" class="flex cursor-pointer justify-between items-center p-2 md:float-right" @click="change_sent(!this.getCurrentProject.sent_notsent)">
            <div class="w-32 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-blue-600': this.getCurrentProject.sent_notsent}">
                <div class="bg-white w-20 h-10 rounded-full shadow-md text-sm font-bold transform duration-300 ease-in-out" :class="{ 'translate-x-12': this.getCurrentProject.sent_notsent}"><div class="px-2 py-2.5 text-xs" v-if="!this.getCurrentProject.sent_notsent">NOT SENT</div><div class="px-2 py-2.5 text-xs" v-if="this.getCurrentProject.sent_notsent">SENT</div></div>
            </div>
        </div>
    </div>
    <div v-if="this.getUser">
        <div v-if="this.getUser.role_id===3 && !pdf" class="flex cursor-pointer justify-between items-center p-2 md:float-right" @click="change_approved(!this.getCurrentProject.approved_notapproved)">
            <div class="w-32 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-600': this.getCurrentProject.approved_notapproved}">
                <div class="bg-white w-20 h-10 rounded-full shadow-md text-sm font-bold transform duration-300 ease-in-out" :class="{ 'translate-x-12': this.getCurrentProject.approved_notapproved,}"><div class="px-2 py-1 text-xs" v-if="!this.getCurrentProject.approved_notapproved">NOT APPROVED</div><div class="px-2 py-2.5 text-xs" v-if="this.getCurrentProject.approved_notapproved">APPROVED</div></div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="inline-block mt-2 md:absolute md:right-5">
            <div class="flex mt-2 text-blue-600 font-extrabold text-3xl leading-normal">
                <div class="mr-2 text-lg inline-block">Average: </div>
                <div class="text-lg mr-2 inline-block">{{ this.getCurrentProject.average_hours }}h</div>
                <div class="text-lg inline-block">{{ this.getCurrentProject.average_minutes }}m</div>
            </div>
            <div class="flex mt-2 text-green-600 font-extrabold text-3xl leading-normal">
                <div class="mr-2 text-lg inline-block">Best Case: </div>
                <div class="text-lg mr-2 inline-block">{{ this.getCurrentProject.best_hours }}h</div>
                <div class="text-lg inline-block">{{ this.getCurrentProject.best_minutes }}m</div>
            </div>
            <div class="flex mt-2 text-red-600 font-extrabold text-3xl leading-normal">
                <div class="mr-2 text-lg inline-block">Worst Case: </div>
                <div class="text-lg mr-2 inline-block">{{ this.getCurrentProject.worst_hours }}h</div>
                <div class="text-lg inline-block">{{ this.getCurrentProject.worst_minutes }}m</div>
            </div>
        </div>
        <div class="mt-5 ml-5 mb-2 flex font-extrabold text-3xl leading-normal">
            <div class="ml-2 mr-4 text-lg inline-block">Assigned to: </div>
            <img v-if="this.getCurrentProject.assigned_to.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+this.getCurrentProject.assigned_to.logo" alt="" >
            <img v-if="!this.getCurrentProject.assigned_to.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" />
            <div class="ml-2 text-lg inline-block">{{ this.getCurrentProject.assigned_to.name }}</div>
        </div>
    <div class="ml-5 mb-2 flex font-extrabold text-3xl leading-normal">
        <div class="ml-2 mr-4 text-lg inline-block">Author: </div>
        <img v-if="this.getCurrentProject.author.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+this.getCurrentProject.author.logo" alt="" >
        <img v-if="!this.getCurrentProject.author.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" />
        <div class="ml-2 text-lg inline-block">{{ this.getCurrentProject.author.name }}</div>
    </div>
    <div class="ml-5 mb-2 flex font-extrabold text-3xl leading-normal">
        <div class="ml-2 mr-2 text-lg inline-block">Created: </div>
        <div class="ml-2 text-lg inline-block">{{ this.getCurrentProject.created }}</div>
    </div>
    <div class="ml-5 mb-2 flex font-extrabold text-3xl leading-normal">
        <div class="ml-2 mr-2 text-lg inline-block">Last Update: </div>
        <div class="ml-2 text-lg inline-block">{{ this.getCurrentProject.updated }}</div>
    </div>
</div>
    <div v-if="delete_task_modal" class="flex flex-col bg-opacity-70 space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-gray-900">
        <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-16 h-16 rounded-2xl p-3 border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex flex-col ml-3">
                        <div class="font-medium leading-none">Delete Task?</div>
                        <p class="text-sm text-gray-600 leading-none mt-1">You cannot undo this action!</p>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-4">
                <button @click="delete_task_modal=false; delete_task_id=null" class="flex-no-shrink inline-block hover:bg-gray-700 bg-gray-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-gray-500 text-white rounded-full">Cancel</button>
                <button @click="delete_task" class="flex-no-shrink bg-red-500 inline-block hover:bg-red-700 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">Delete</button>
            </div>
        </div>
    </div>
    <div v-if="delete_module_modal" class="flex flex-col bg-opacity-70 space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-gray-900">
        <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-16 h-16 rounded-2xl p-3 border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex flex-col ml-3">
                        <div class="font-medium leading-none">Delete Module?</div>
                        <p class="text-sm text-gray-600 leading-none mt-1">You cannot undo this action!</p>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-4">
                <button @click="delete_module_modal=false; delete_module_id=null" class="flex-no-shrink inline-block hover:bg-gray-700 bg-gray-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-gray-500 text-white rounded-full">Cancel</button>
                <button @click="delete_module" class="flex-no-shrink bg-red-500 inline-block hover:bg-red-700 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">Delete</button>
            </div>
        </div>
    </div>
    <div v-if="delete_project_modal" class="flex flex-col bg-opacity-70 space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-gray-900">
        <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-16 h-16 rounded-2xl p-3 border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex flex-col ml-3">
                        <div class="font-medium leading-none">Delete <div class="font-extrabold inline-block italic">"{{this.getCurrentProject.name}}"</div> Project?</div>
                        <p class="text-sm text-gray-600 leading-none mt-1">You cannot undo this action!</p>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-4">
                <button @click="delete_project_modal=false" class="flex-no-shrink inline-block hover:bg-gray-700 bg-gray-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-gray-500 text-white rounded-full">Cancel</button>
                <button @click="delete_project" class="flex-no-shrink bg-red-500 inline-block hover:bg-red-700 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">Delete</button>
            </div>
        </div>
    </div>
    <div id="editor"></div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import html2canvas from "html2canvas"
import { jsPDF } from "jspdf"
import { useRoute } from 'vue-router'

export default{
    data(){
        return {
            pdf: false,
            delete_project_modal: false,
            delete_module_modal: false,
            delete_module_id: null,
            delete_task_modal: false,
            delete_task_id: null,
            project_name_modal: false,
            project_name: null,
            edit: null,
            modal: false,
            module: {
                name: null,
            },
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
    },
    computed:{
        ...mapGetters([
            'getCurrentProject',
            'getProjects',
            'getUser'
        ])
    },
    methods:{
        nextPlease(id){
            if(this.task.name===null) {
                document.getElementById('task_name').focus();
            }
            else if(this.task.best_case.hours===null){
                document.getElementById('task_best_hours').focus();
            }
            else if(this.task.best_case.minutes===null){
                document.getElementById('task_best_minutes').focus();
            }
            else if(this.task.worst_case.hours===null){
                document.getElementById('task_worst_hours').focus();
            }
            else if(this.task.worst_case.minutes===null){
                document.getElementById('task_worst_minutes').focus();
            }
            else{
                this.add_task(id)
            }
        },
        delete_project(){
            axios.get('http://estimate.local/api/delete_project/'+this.getCurrentProject.id)
                .then(response => {
                    this.delete_project_modal=false
                    this.$toast.success('Project deleted!')
                    this.$router.push('/projects')
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        delete_module(){
            axios.get('http://estimate.local/api/delete_module/'+this.delete_module_id)
                .then(response => {
                    this.delete_module_modal=false
                    this.delete_module_id=null
                    this.$toast.success('Module deleted!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        delete_task(){
            axios.get('http://estimate.local/api/delete_task/'+this.delete_task_id)
                .then(response => {
                    this.delete_task_modal=false
                    this.delete_task_id=null
                    this.$toast.success('Task deleted!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        edit_project_name(){
            axios.post('http://estimate.local/api/edit_project', {
                project_id: this.getCurrentProject.id,
                name: this.project_name
            })
                .then(response => {
                    this.project_name_modal=false
                    this.project_name=null
                    this.$toast.success('Project updated!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        change_sent(value){
            axios.post('http://estimate.local/api/edit_project', {
                project_id: this.getCurrentProject.id,
                sent: value
            })
                .then(response => {
                    this.$toast.success('Project updated!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        change_approved(value){
            axios.post('http://estimate.local/api/edit_project', {
                project_id: this.getCurrentProject.id,
                approved: value
            })
                .then(response => {
                    this.$toast.success('Project updated!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        change_public(value){
            axios.post('http://estimate.local/api/edit_project', {
                project_id: this.getCurrentProject.id,
                public: value
            })
                .then(response => {
                    this.$toast.success('Project updated!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        edit_module(value){
            if(this.getUser.id===this.getCurrentProject.author.id){
                if(this.edit!=value) {
                    this.edit = value
                }
                else{
                    this.edit=null
                }
            }
        },
        add_module(){
            if(this.module.name) {
                axios.post('http://estimate.local/api/add_module', {
                    name: this.module.name,
                    project_id: this.getCurrentProject.id
                })
                    .then(response => {
                        this.$toast.success('Module created!')
                        this.$store.commit('setCurrentProject', response.data)
                        this.module.name = null
                        this.modal=null
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
            else{
                this.$toast.error('Project name cannot be empty!')
            }
        },
        add_task(module_id){
            if(this.task.name && this.task.best_case.hours && this.task.best_case.minutes && this.task.worst_case.hours && this.task.worst_case.minutes) {
                axios.post('http://estimate.local/api/add_task', {
                    name: this.task.name,
                    best_hours: this.task.best_case.hours,
                    best_minutes: this.task.best_case.minutes,
                    worst_hours: this.task.worst_case.hours,
                    worst_minutes: this.task.worst_case.minutes,
                    module_id: module_id
                })
                    .then(response => {
                        this.task.name=null
                        this.task.best_case.hours=null
                        this.task.best_case.minutes=null
                        this.task.worst_case.hours=null
                        this.task.worst_case.minutes=null
                        this.$toast.success('Module created!')
                        this.$store.commit('setCurrentProject', response.data)
                        this.module.name = null
                        this.modal=null
                        document.getElementById('task_name').focus()
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
            else{
                this.$toast.error('All fields are required!')
            }
        },
        async save_pdf(){
            let name=this.getCurrentProject.name
            await new Promise(r => setTimeout(r, 1000));
            html2canvas(document.getElementById('pdf')).then(function(canvas) {
                let imgData = canvas.toDataURL("image/jpeg", 1.0);
                let width = document.getElementById("pdf").clientWidth
                let height = document.getElementById("pdf").clientHeight
                if(width<height) {
                    var pdf = new jsPDF('p', 'pt', [width, height]);
                }
                else{
                    var pdf = new jsPDF('l', 'pt', [width, height]);
                }
                pdf.addImage(imgData, 'JPEG', 0, 0, width, height);
                pdf.save(name+".pdf");
            });
            this.pdf=false
        }
    },
    created(){
        axios.get('http://estimate.local/api/get_projects', {
            name: this.name,
        })
            .then(response => {
                this.$store.commit('setProjects', response.data)
            })
            .catch(function (error) {
                console.error(error);
            });
        let current=null
        this.getProjects.findIndex(function(project) {
            if(project.name === useRoute().params.name)
                current=project
        });
        this.$store.commit('setCurrentProject', current)
    }
}
</script>

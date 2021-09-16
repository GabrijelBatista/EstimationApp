<template>
<div id="pdf" class=" bg-cta-light text-brand-dark overflow-x-auto" ref="content">
    <button v-if="!pdf" @click="save_pdf(pdf=true)" class="absolute top-30 right-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
    </button>
<div class="min-w-screen min-h-scree flex justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
            <div class="flex m-auto w-max">
                <div v-if="this.getUser && this.getCurrentProject" class="p-5 font-extrabold text-brand-dark uppercase text-3xl leading-normal">{{ this.getCurrentProject.name }}
                    <svg @click="project_name_modal=true" v-if="this.getCurrentProject.author.id===this.getUser.id && !pdf" xmlns="http://www.w3.org/2000/svg" class="inline-block cursor-pointer text-yellow-500 transform hover:scale-110 hover:text-yellow-700 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <svg v-if="this.getUser.id===this.getCurrentProject.author.id && !pdf" @click="delete_project_modal=true" class="w-6 inline-block transform cursor-pointer text-danger hover:text-danger-dark hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>
        <div v-if="this.getUser && this.getCurrentProject" @dblclick="edit_module(value.id)" class="flex flex-col" v-for="(value, index) in this.getCurrentProject.modules" :key="value.id">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-3 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow bg-brand-dark overflow-hidden border-b border-brand-light rounded-2xl">
            <div class="mt-4">
            <div class="min-w-max relative w-full">
                <div class="pb-3 font-bold text-white uppercase text-lg leading-normal">
                    <div class="absolute left-4 w-6">
                        {{ index+1 }}.
                    </div>
                    <div class="inline-block">
                        <div class="inline-block" v-if="edit_module_name!=value.name">{{ value.name }}</div>
                        <input class="inline-block text-brand-dark text-center font-medium" v-if="edit_module_name===value.name" v-model="module_name" v-on:keyup.enter="save_module_name(value.id)">
                        <svg v-if="this.getUser.id===this.getCurrentProject.assigned_id && !pdf" @click="open_edit_module_name(value.name)" xmlns="http://www.w3.org/2000/svg" class="inline-block cursor-pointer ml-2 text-yellow-500 transform hover:scale-110 hover:text-yellow-700 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <div v-if="this.getUser.id===this.getCurrentProject.assigned_id && !pdf" @click="delete_module_modal=true; delete_module_id=value.id" class="w-6 absolute right-4 inline-block transform cursor-pointer text-danger hover:text-danger-dark hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
            </div>
            <table class="min-w-max w-full bg-brand-light">
                <thead class="bg-brand">
                <tr class="text-white text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No.</th>
                    <th class="py-3 px-6 text-left">TASK</th>
                    <th class="py-3 px-6 text-cta text-center">BEST CASE</th>
                    <th class="py-3 px-6 text-blue-600 text-center">AVERAGE</th>
                    <th class="py-3 px-6 text-red-600 text-center">WORST CASE</th>
                    <th class="py-3 px-6 text-center">
                        <svg v-if="this.getUser.id===this.getCurrentProject.assigned_id && !pdf" @click="edit_module(value.id)" xmlns="http://www.w3.org/2000/svg" class="inline-block cursor-pointer text-yellow-500 transform hover:scale-110 hover:text-yellow-700 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </th>
                </tr>
                </thead>
                <tbody class="text-bg-dark text-sm bg-brand-light ">
                <tr v-if="value.tasks" v-for="(value2, index2) in value.tasks" :key="value2.id" class="border-b border-brand-light">
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
                        <div class="font-bold flex items-center text-cta justify-center">
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
                            <div @click="delete_task_modal=true; delete_task_id=value2.id" class="w-4 mr-2 transform cursor-pointer text-danger hover:text-danger-dark hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-if="edit===value.id && !pdf" class="border-2 border-brand-light">
                    <td class="py-3 px-6 text-left whitespace-nowrap w-16">
                        <div class="flex w-16 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex  items-center">
                            <input id="task_name" v-on:keyup.enter="nextPlease(value.id)" v-model="task.name" type="text" required class=" appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Task" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex w-36 mx-auto items-center">
                            <input id="task_best_hours" v-on:keyup.enter="nextPlease(value.id)" v-model="task.best_case.hours" type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="h" />:
                            <input id="task_best_minutes" v-on:keyup.enter="nextPlease(value.id)" v-model="task.best_case.minutes" type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex  mx-auto w-36 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex mx-auto w-36 items-center">
                            <input id="task_worst_hours" v-on:keyup.enter="nextPlease(value.id)" v-model="task.worst_case.hours" type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="h" />:
                            <input id="task_worst_minutes" v-on:keyup.enter="nextPlease(value.id)" v-model="task.worst_case.minutes" type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="m" />
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
                <thead class="bg-brand-dark">
                <tr class="text-white text-sm leading-normal">
                    <th class="py-3 px-6 text-left"></th>
                    <th class="py-3 px-6 text-left">TOTAL</th>
                    <th class="py-3 px-6 text-cta text-center">{{ value.best_hours }}h {{ value.best_minutes }}m</th>
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
    <div v-if="project_name_modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-darkest bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <div class="font-extrabold mx-auto text-2xl mb-4">CHANGE PROJECT NAME</div>
            <input v-if="this.getCurrentProject" v-on:keyup.enter="edit_project_name" v-model="project_name" type="text" required class="text-center mx-auto appearance-none rounded-none relative block w-full py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" :placeholder="this.getCurrentProject.name" />
            <div class="mx-auto block">
                <div @click="project_name_modal=false" class="inline-block hover:bg-brand-dark bg-brand px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Close</span>
                </div>
                <div @click="edit_project_name" class="inline-block hover:bg-brand-dark bg-brand px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
    <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-darkest bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <div class="font-extrabold mx-auto text-2xl mb-4">CREATE NEW MODULE</div>
            <input v-on:keyup.enter="add_module" v-model="module.name" type="text" required class="text-center mx-auto appearance-none rounded-none relative block w-full py-2 border border-brand-light placeholder-brand text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Module Name" />
            <div class="mx-auto block">
                <div @click="modal=false" class="inline-block hover:bg-brand-dark bg-brand px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Close</span>
                </div>
                <div @click="add_module" class="inline-block hover:bg-brand-dark bg-brand px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
    <div v-if="this.getUser && this.getCurrentProject" class="flex m-auto w-max">
        <div @click="modal=true" v-if="this.getUser.id===this.getCurrentProject.assigned_to.id && !pdf" class="px-5 py-3 mt-4 cursor-pointer bg-brand-light hover:bg-brand rounded-2xl border-2 font-extrabold uppercase text-xl leading-normal">Create Module</div>
    </div>
    <div v-if="this.getUser && this.getCurrentProject">
        <div v-if="this.getUser.id===this.getCurrentProject.assigned_to.id && !pdf" class="flex cursor-pointer justify-between items-center p-2 md:float-right md:mr-5" @click="change_public(!this.getCurrentProject.private_public)">
            <div class="w-32 h-10 flex items-center bg-cta-light rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-purple-400': this.getCurrentProject.private_public}">
                <div class="bg-white w-20 h-10 rounded-full shadow-md text-sm font-bold transform duration-300 ease-in-out" :class="{ 'translate-x-12': this.getCurrentProject.private_public,}"><div class="px-2 py-1 text-xs" v-if="!this.getCurrentProject.private_public">IN PROGRESS</div><div class="px-2 py-2.5 text-xs" v-if="this.getCurrentProject.private_public">DONE</div></div>
            </div>
        </div>
    </div>
    <div v-if="this.getUser && this.getCurrentProject">
        <div v-if="this.getUser.id===this.getCurrentProject.author.id && !pdf && this.getCurrentProject.private_public===1" class="flex cursor-pointer justify-between items-center p-2 md:float-right" @click="change_sent(!this.getCurrentProject.sent_notsent)">
            <div class="w-32 h-10 flex items-center bg-cta-light rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-blue-600': this.getCurrentProject.sent_notsent}">
                <div class="bg-white w-20 h-10 rounded-full shadow-md text-sm font-bold transform duration-300 ease-in-out" :class="{ 'translate-x-12': this.getCurrentProject.sent_notsent}"><div class="px-2 py-2.5 text-xs" v-if="!this.getCurrentProject.sent_notsent">NOT SENT</div><div class="px-2 py-2.5 text-xs" v-if="this.getCurrentProject.sent_notsent">SENT</div></div>
            </div>
        </div>
    </div>
    <div v-if="this.getUser && this.getCurrentProject">
        <div v-if="this.getUser.id===this.getCurrentProject.author.id && !pdf && this.getCurrentProject.private_public===1" class="flex cursor-pointer justify-between items-center p-2 md:float-right" @click="change_approved(!this.getCurrentProject.approved_notapproved)">
            <div class="w-32 h-10 flex items-center bg-cta-light rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-cta': this.getCurrentProject.approved_notapproved}">
                <div class="bg-white w-20 h-10 rounded-full shadow-md text-sm font-bold transform duration-300 ease-in-out" :class="{ 'translate-x-12': this.getCurrentProject.approved_notapproved,}"><div class="px-2 py-1 text-xs" v-if="!this.getCurrentProject.approved_notapproved">NOT APPROVED</div><div class="px-2 py-2.5 text-xs" v-if="this.getCurrentProject.approved_notapproved">APPROVED</div></div>
            </div>
        </div>
    </div>
    <div v-if="this.getCurrentProject" class="mb-5">
        <div class="inline-block mt-2 md:absolute md:right-5">
            <div class="flex mt-2 text-blue-600 font-extrabold text-3xl leading-normal">
                <div class="mr-2 text-lg inline-block">Average: </div>
                <div class="text-lg mr-2 inline-block">{{ this.getCurrentProject.average_hours }}h</div>
                <div class="text-lg inline-block">{{ this.getCurrentProject.average_minutes }}m</div>
            </div>
            <div class="flex mt-2 text-cta font-extrabold text-3xl leading-normal">
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
            <div class="ml-2 mr-4 text-lg inline-block">Dev: </div>
            <img v-if="this.getCurrentProject.assigned_to.logo && !pdf" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+this.getCurrentProject.assigned_to.logo" alt="" >
            <img v-if="!this.getCurrentProject.assigned_to.logo && !pdf" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" />
            <div class="ml-2 text-lg inline-block">{{ this.getCurrentProject.assigned_to.name }}</div>
        </div>
        <div class="ml-5 mb-2 flex font-extrabold text-3xl leading-normal">
            <div class="ml-2 mr-4 text-lg inline-block">PM: </div>
            <img v-if="this.getCurrentProject.pm.logo && !pdf" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+this.getCurrentProject.pm.logo" alt="" >
            <img v-if="!this.getCurrentProject.pm.logo && !pdf" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" />
            <div class="ml-2 text-lg inline-block">{{ this.getCurrentProject.pm.name }}</div>
        </div>
    <div class="ml-5 mb-2 flex font-extrabold text-3xl leading-normal">
        <div class="ml-2 mr-4 text-lg inline-block">Author: </div>
        <img v-if="this.getCurrentProject.author.logo && !pdf" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+this.getCurrentProject.author.logo" alt="" >
        <img v-if="!this.getCurrentProject.author.logo && !pdf" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" />
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
    <div v-if="delete_task_modal" class="flex flex-col bg-gray-darkest bg-opacity-75 space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-brand-dark">
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
                        <p class="text-sm text-cta leading-none mt-1">You cannot undo this action!</p>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-4">
                <button @click="delete_task_modal=false; delete_task_id=null" class="flex-no-shrink inline-block hover:bg-brand-dark bg-brand px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-brand text-white rounded-full">Cancel</button>
                <button @click="delete_task" class="flex-no-shrink bg-brand inline-block hover:bg-brand-dark px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-brand text-white rounded-full">Delete</button>
            </div>
        </div>
    </div>
    <div v-if="delete_module_modal" class="flex flex-col bg-opacity-75 bg-gray-darkest space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-brand-dark">
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
                        <p class="text-sm text-cta leading-none mt-1">You cannot undo this action!</p>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-4">
                <button @click="delete_module_modal=false; delete_module_id=null" class="flex-no-shrink inline-block hover:bg-brand-dark bg-brand px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-brand text-white rounded-full">Cancel</button>
                <button @click="delete_module" class="flex-no-shrink hover:bg-brand-dark bg-brand inline-block px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-brand text-white rounded-full">Delete</button>
            </div>
        </div>
    </div>
    <div v-if="delete_project_modal" class="flex flex-col bg-opacity-75 bg-gray-darkest space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none">
        <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-16 h-16 rounded-2xl p-3 border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div v-if="this.getCurrentProject" class="flex flex-col ml-3">
                        <div class="font-medium leading-none">Delete <div class="font-extrabold inline-block italic">"{{this.getCurrentProject.name}}"</div> Project?</div>
                        <p class="text-sm text-cta leading-none mt-1">You cannot undo this action!</p>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-4">
                <button @click="delete_project_modal=false" class="flex-no-shrink inline-block hover:bg-brand-dark bg-brand px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-brand text-white rounded-full">Cancel</button>
                <button @click="delete_project" class="flex-no-shrink inline-block hover:bg-brand-dark bg-brand px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-brand text-white rounded-full">Delete</button>
            </div>
        </div>
    </div>
    <div v-if="!pdf && this.getCurrentProject" class="antialiased mt-4 bg-brand-light p-4 rounded-xl mx-auto max-w-screen-sm">
        <h3 class="mb-4 text-lg font-semibold text-brand-dark">Comments</h3>

        <div v-if="this.getCurrentProject.comments" class=" space-y-4">

            <div :key="comment.id" v-for="comment in this.getCurrentProject.comments" class="flex">
                <div v-if="comment.user.logo" class="flex-shrink-0 mr-3">
                    <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" :src="'/storage/images/profile/'+comment.user.logo" alt="">
                </div>
                <div v-if="!comment.user.logo" class="flex-shrink-0 mr-3">
                    <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" src="/storage/images/user.png" alt="">
                </div>
                <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                    <div v-if="this.getUser" class="mb-3">
                        <strong class="inline-block">{{comment.user.name}}</strong>
                        <svg v-if="this.getUser.id===comment.user_id" @click="check_editing_comment(comment.id, comment.user_id); editing_comment_text=comment.text" xmlns="http://www.w3.org/2000/svg" class="inline-block -ml-5 cursor-pointer text-yellow-500 float-right transform hover:scale-110 hover:text-yellow-700 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <svg v-if="this.getUser.id===comment.user_id" @click="delete_comment(comment.id)" class="w-5 -mr-4 float-right transform cursor-pointer text-danger hover:text-danger-dark hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                        <div v-if="editing_comment!=comment.id" @dblclick="check_editing_comment(comment.id, comment.user_id); editing_comment_text=comment.text" class="w-full">{{comment.text}}</div>
                        <textarea v-if="editing_comment===comment.id" v-on:keyup.esc="editing_comment=null; editing_comment_text=null" v-on:keyup.enter="edit_comment(comment.id)" v-model="editing_comment_text" class="h-32 resize-none w-full"></textarea>
                        <span v-if="editing_comment===comment.id" @click="editing_comment=null; editing_comment_text=null" class=" text-xs cursor-pointer float-left text-brand font-italic">Cancel</span>
                    <div v-if="reply_id===comment.id">
                    <h4 class="my-5 uppercase tracking-wide text-brand font-bold text-xs">Replies</h4>
                    <div :key="reply.id" v-for="reply in comment.replies" class="space-y-4 my-5">
                        <div class="flex">
                            <div v-if="reply.user.logo" class="flex-shrink-0 mr-3">
                                <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" :src="'/storage/images/profile/'+reply.user.logo" alt="">
                            </div>
                            <div v-if="!reply.user.logo" class="flex-shrink-0 mr-3">
                                <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" src="/storage/images/user.png" alt="">
                            </div>
                            <div class="flex-1 bg-white rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                                <div class="mb-3">
                                    <strong class="inline-block">{{reply.user.name}}</strong>
                                    <svg v-if="this.getUser.id===reply.user_id" @click="check_editing_reply(reply.id, reply.user_id); editing_reply_text=reply.text" xmlns="http://www.w3.org/2000/svg" class="inline-block -ml-5 cursor-pointer text-yellow-500 float-right transform hover:scale-110 hover:text-yellow-700 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <svg v-if="this.getUser.id===reply.user_id" @click="delete_reply(comment.id,reply.id)" class="w-5 -mr-4 float-right transform cursor-pointer text-danger hover:text-danger-dark hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                                <p v-if="editing_reply!=reply.id" @dblclick="check_editing_reply(reply.id, reply.user_id); editing_reply_text=reply.text" class="text-xs sm:text-sm">
                                    {{reply.text}}
                                </p>
                                <textarea v-if="editing_reply===reply.id" v-on:keyup.esc="editing_reply=null; editing_reply_text=null" v-on:keyup.enter="edit_reply(reply.id)" v-model="editing_reply_text" class="w-full resize-none h-24"></textarea>
                                <span v-if="editing_reply===reply.id" @click="editing_reply=null; editing_reply_text=null" class=" text-xs cursor-pointer float-left text-brand font-italic">Cancel</span>
                            </div>
                        </div>
                    </div>
                    </div>
                        <span @click="show_reply(comment.id)" class="cursor-pointer -mr-4 text-sm float-right text-brand font-italic">Reply</span>

                    <div v-if="comment.replies[0] && reply_id!=comment.id" class="mt-4 flex items-center">
                        <div @click="show_reply(comment.id)" class="flex cursor-pointer -space-x-2 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </div>
                        <div @click="show_reply(comment.id)" class="text-sm text-brand cursor-pointer font-semibold">
                            {{ comment.replies.length }} replies
                        </div>
                    </div>

                    <div class="mx-auto mt-5" v-if="reply_id===comment.id">
                        <textarea class="flex-1 w-11/12 outline-brand-dark rounded-lg float-left ml-3 px-4 py-2 sm:px-6 sm:py-4 leading-relaxed my-3 h-24 resize-none" v-on:keyup.enter="add_reply(comment.id)" v-model="reply" placeholder="Leave a reply..."></textarea>
                        <button @click="add_reply(comment.id)" class="py-2 bg-brand hover:bg-brand-dark text-white font-bold rounded mb-4 px-4 float-right">ADD</button>
                    </div>
                    <span v-if="reply_id===comment.id" @click="reply_id=null" class="mt-2 text-sm cursor-pointer float-left text-brand font-italic">Hide replies</span>
                </div>
            </div>
        </div>
            <textarea class="flex-1 w-11/12 outline-brand-dark rounded-lg float-right px-4 py-2 sm:px-6 sm:py-4 leading-relaxed my-3 h-32 resize-none" v-on:keyup.enter="add_comment" v-model="comment" placeholder="Leave a comment..."></textarea>
            <button @click="add_comment" class="py-2 bg-brand hover:bg-brand-dark text-white font-bold rounded mb-4 px-4 float-right">ADD</button>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import html2canvas from "html2canvas"
import { jsPDF } from "jspdf"
import { useRoute } from 'vue-router'
import axios from "axios";

export default{
    data(){
        return {
            editing_reply_text: null,
            editing_reply: null,
            editing_comment_text: null,
            editing_comment: null,
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
            comment:null,
            reply_id:null,
            reply:null,
            module_name:null,
            edit_module_name:false,
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
        open_edit_module_name(name){
            if(!this.edit_module_name) {
                this.edit_module_name = name
            }
            else{
                this.edit_module_name=null
            }
            if(this.module_name!==name) {
                this.module_name = name
            }
            else{
                this.module_name=null
            }
        },
        save_module_name(id){
            axios.post('http://estimate.local.com/api/edit_module', {
                module_id: id,
                name: this.module_name
            })
                .then(response => {
                    let e=this
                    this.getCurrentProject.modules.findIndex(function (module){
                        if(module.id===id){
                            module.name=e.module_name
                        }
                    })
                    this.$toast.success('Module updated!')
                    this.edit_module_name=false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        check_editing_reply(id, user_id){
            if(user_id===this.getUser.id){
                this.editing_reply=id
            }
        },
        edit_reply(id){
            axios.post('http://estimate.local.com/api/edit_reply', {
                reply_id: id,
                text: this.editing_reply_text
            })
                .then(response => {
                    let e=this
                    this.$toast.success('Reply edited!')
                    this.editing_reply=null
                    this.getCurrentProject.comments.findIndex(function (comment) {
                        comment.replies.findIndex(function (reply){
                            if(id===reply.id){
                                reply.text=e.editing_reply_text
                            }
                        })
                    })
                    this.editing_reply_text=null
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        check_editing_comment(id, user_id){
            if(user_id===this.getUser.id){
                this.editing_comment=id
            }
        },
        edit_comment(id){
            axios.post('http://estimate.local.com/api/edit_comment', {
                comment_id: id,
                text: this.editing_comment_text
            })
                .then(response => {
                    let e=this
                    this.$toast.success('Comment edited!')
                    this.editing_comment=null
                    this.getCurrentProject.comments.findIndex(function (comment) {
                        if(id===comment.id){
                            comment.text=e.editing_comment_text
                        }
                    })
                    this.editing_comment_text=null
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        delete_comment(id){
            let e=this
            if (confirm("Delete this comment?") === true) {
                axios.get('http://estimate.local.com/api/delete_comment/'+id)
                    .then(response => {
                        this.$toast.success('Comment deleted!')
                        this.getCurrentProject.comments.findIndex(function (comment) {
                            if(id===comment.id){
                                const index = e.getCurrentProject.comments.indexOf(comment);
                                if (index > -1) {
                                    e.getCurrentProject.comments.splice(index, 1)
                                }
                            }
                        })

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        delete_reply(comment_id, reply_id){
            if (confirm("Delete this reply?") === true) {
                axios.get('http://estimate.local.com/api/delete_reply/'+reply_id)
                    .then(response => {
                        this.$toast.success('Reply deleted!')
                        this.getCurrentProject.comments.findIndex(function (comment) {
                            if(comment_id===comment.id){
                                comment.replies.findIndex(function (reply) {
                                    if(reply_id===reply.id){
                                        const index = comment.replies.indexOf(reply);
                                        if (index > -1) {
                                            comment.replies.splice(index, 1)
                                        }
                                    }
                                })
                            }
                        })
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        add_reply(id){
            let e=this
            let first=null
            let second=null
            let name=this.getUser.name
            this.getCurrentProject.comments.findIndex(function (comment) {
                if(id===comment.id){
                    if(comment.user_id!==e.getUser.id){
                        first=comment.user_id
                    }
                    comment.replies.findIndex(function (reply){
                        if(first===null && reply.user_id!==e.getUser.id){
                            first=reply.user_id
                        }
                        else if(first!=null && reply.user_id!==e.getUser.id && first!==e.getUser.id){
                            second=reply.user_id
                        }
                    })
                }
            })
            axios.post('http://estimate.local.com/api/add_reply', {
                comment_id: id,
                reply: this.reply
            })
                .then(response => {
                    axios.post('http://estimate.local.com/api/estimations-notification', {
                        for: first,
                        pm: second,
                        body: name+' replies on your comment for '+this.getCurrentProject.name+' project!',
                        url: this.getCurrentProject.name
                    })
                        .then(response => {
                            //console.log(response)
                        })
                        .catch(function (error) {
                            console.log(error.data)
                        });
                    this.$toast.success('Reply posted!')
                    this.reply=null
                    this.getCurrentProject.comments.findIndex(function (comment) {
                        if(id===comment.id){
                            return comment.replies.push(response.data)
                        }
                    })

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        show_reply(id){
            if(this.reply_id===id){
                this.reply_id=null
            }
            else{
                this.reply_id=id
            }
        },
        add_comment(){
            let first=null
            let second=null
            if(this.getUser.id===this.getCurrentProject.assigned_id){
                 first=this.getCurrentProject.user_id
                 second=this.getCurrentProject.pm_id
            }
            else if(this.getUser.id===this.getCurrentProject.pm_id){
                 first=this.getCurrentProject.user_id
                 second=this.getCurrentProject.assigned_id
            }
            else if(this.getUser.id===this.getCurrentProject.user_id){
                 first=this.getCurrentProject.pm_id
                 second=this.getCurrentProject.assigned_id
            }
            let name=this.getUser.name
            axios.post('http://estimate.local.com/api/add_comment', {
                project_id: this.getCurrentProject.id,
                comment: this.comment
            })
                .then(response => {
                    axios.post('http://estimate.local.com/api/estimations-notification', {
                        for: first,
                        pm: second,
                        body: name+' commented on '+this.getCurrentProject.name+' project!',
                        url: this.getCurrentProject.name
                    })
                        .then(response => {
                            //console.log(response)
                        })
                        .catch(function (error) {
                            console.log(error.data)
                        });
                    this.$toast.success('Comment posted!')
                    this.comment=null
                    this.getCurrentProject.comments.push(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
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
            axios.get('http://estimate.local.com/api/delete_project/'+this.getCurrentProject.id)
                .then(response => {
                    this.$toast.success('Project deleted!')
                    this.$router.push('/')
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        delete_module(){
            axios.get('http://estimate.local.com/api/delete_module/'+this.delete_module_id)
                .then(response => {
                    this.delete_module_modal=false
                    this.delete_module_id=null
                    this.$toast.success('Module deleted!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        delete_task(){
            axios.get('http://estimate.local.com/api/delete_task/'+this.delete_task_id)
                .then(response => {
                    this.delete_task_modal=false
                    this.delete_task_id=null
                    this.$toast.success('Task deleted!')
                    this.$store.commit('setCurrentProject', response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        edit_project_name(){
            axios.post('http://estimate.local.com/api/edit_project', {
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
                    console.log(error);
                });
        },
        change_sent(value){
            if (confirm("Are you sure that you want to status of this project?") === true) {
                axios.post('http://estimate.local.com/api/edit_project', {
                    project_id: this.getCurrentProject.id,
                    sent: value
                })
                    .then(response => {
                        if(value===1) {
                            axios.post('http://estimate.local.com/api/estimations-notification', {
                                for: response.data.assigned_to.id,
                                pm: response.data.project_manager.id,
                                body: 'Estimation for ' + response.data.name + ' project is sent to client!',
                                url: response.data.name
                            })
                                .then(response => {
                                    //console.log(response)
                                })
                                .catch(function (error) {
                                    console.log(error.data)
                                });
                        }
                        this.$toast.success('Project updated!')
                        this.$store.commit('setCurrentProject', response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        change_approved(value){
            if (confirm("Are you sure that you want to status of this project?") === true) {
                axios.post('http://estimate.local.com/api/edit_project', {
                    project_id: this.getCurrentProject.id,
                    approved: value
                })
                    .then(response => {
                        console.log(value)
                        if(value===true) {
                            axios.post('http://estimate.local.com/api/estimations-notification', {
                                for: response.data.assigned_to.id,
                                pm: response.data.project_manager.id,
                                body: 'Estimation for ' + response.data.name + ' project is approved by client!',
                                url: response.data.name
                            })
                                .then(response => {
                                    //console.log(response)
                                })
                                .catch(function (error) {
                                    console.log(error.data)
                                });
                        }
                        this.$toast.success('Project updated!')
                        this.$store.commit('setCurrentProject', response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        change_public(value){
            if (confirm("Are you sure that you want to change status of this project?") === true) {
                axios.post('http://estimate.local.com/api/edit_project', {
                    project_id: this.getCurrentProject.id,
                    public: value
                })
                    .then(response => {
                        if(value===1) {
                            axios.post('http://estimate.local.com/api/estimations-notification', {
                                for: response.data.author.id,
                                pm: response.data.project_manager.id,
                                body: 'Estimation for ' + response.data.name + ' project is done!',
                                url: response.data.name
                            })
                                .then(response => {
                                    //console.log(response)
                                })
                                .catch(function (error) {
                                    console.log(error.data)
                                });
                        }
                        this.$toast.success('Project updated!')
                        this.$store.commit('setCurrentProject', response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        edit_module(value){
            if(this.getUser.id===this.getCurrentProject.assigned_to.id){
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
                axios.post('http://estimate.local.com/api/add_module', {
                    name: this.module.name,
                    project_id: this.getCurrentProject.id
                })
                    .then(response => {
                        this.getCurrentProject.modules.push(response.data)
                        this.$toast.success('Module created!')
                        this.module.name = null
                        this.modal=null
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
            else{
                this.$toast.error('Project name cannot be empty!')
            }
        },
        add_task(module_id){
                axios.post('http://estimate.local.com/api/add_task', {
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
                        console.log(error);
                    });
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
        let route_name=useRoute()
        axios.get('http://estimate.local.com/api/get_current_project/'+route_name.params.name)
            .then(response => {
                if(!response.data){
                    this.$router.push('/')
                }
                else {
                    this.$store.commit('setCurrentProject', response.data)
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    },
}
</script>

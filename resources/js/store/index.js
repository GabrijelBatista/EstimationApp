import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import {useRoute} from "vue-router";

export default createStore({
    state: {
        user: null,
        current_project: null,
        projects: null,
        users: [],
        user_notifications: [],
        new_notification: false,
        live: false,
        developers: [],
        pms: []
    },
    actions: {

    },
    getters: {
        getDevelopers: state => state.developers,
        getPms: state => state.pms,
        getLive: state => state.live,
        getUser: state => state.user,
        getUserNotifications: state => state.user_notifications,
        getNewNotification: state => state.new_notification,
        getUsers: state => state.users,
        getProjects: state => state.projects,
        getCurrentProject: state => state.current_project,
    },
    mutations: {
        readNotification(state, notification){
            state.new_notification=false
        },
        setUserNotifications(state, notification) {
            if(notification===null) {
                state.user_notifications=[]
            }
            else{
                state.new_notification=true
                const newArray = [notification].concat(state.user_notifications)
                state.user_notifications=newArray
            }
        },
        setNewNotification(state, notification) {
            state.new_notification=notification;
        },
        setLive(state, live) {
            state.live=live;
        },
        setUser(state, user) {
            state.user=user;
        },
        setUsers(state, users) {
            state.developers=[];
            state.pms=[];
            state.users=users;
            users.findIndex(function (user) {
                if(user.role_id===1){
                    state.developers.push(user)
                }
                else if(user.role_id===2){
                    state.pms.push(user)
                }
            })
        },
        setCurrentProject(state, project) {
            state.current_project=project;
        },
        setProjects(state, projects) {
            state.projects=projects;
        },
    },
    plugins: [createPersistedState({
        storage: window.localStorage,
    })],
});

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
        live: false
    },
    actions: {

    },
    getters: {
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
            state.user_notifications.findIndex(function (not) {
                if(not.read_at){
                    state.new_notification=true
                }
                if(notification.id===not.id){
                    not.read_at=notification.read_at
                }
            });
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
            state.users=users;
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

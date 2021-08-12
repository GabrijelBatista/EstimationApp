import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

export default createStore({
    state: {
        user: null,
        current_project: null,
        projects: null
    },
    actions: {

    },
    getters: {
        getUser: state => state.user,
        getProjects: state => state.projects,
        getCurrentProject: state => state.current_project,
    },
    mutations: {
        setUser(state, user) {
            state.user=user;
        },
        setCurrentProject(state, project) {
            state.current_project=project;
        },
        setProjects(state, projects) {
            state.projects=projects;
        },
    },
    plugins: [createPersistedState({
        storage: window.sessionStorage,
    })],
});

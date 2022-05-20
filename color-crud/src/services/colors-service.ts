import axios from 'axios';

const HOST_NAME = "http://localhost:2222";
const API_EXTENSION = "/api"

const ROUTE_GROUP = "/colors";

export const getColors = () => axios.get(HOST_NAME + API_EXTENSION + ROUTE_GROUP + '/list');
export const getColorById = (id: any) => axios.get(HOST_NAME + API_EXTENSION + ROUTE_GROUP + `/${id}`);
export const createColor = (name: string, hex_value: string, status: boolean) => axios.post(HOST_NAME + API_EXTENSION + ROUTE_GROUP + `/create`, {name, hex_value, status});
export const editColor = (id: number, name: string, hex_value: string, status: boolean) => axios.patch(HOST_NAME + API_EXTENSION + ROUTE_GROUP + `/${id}/edit`, {name, hex_value, status});
export const changeStatus = (id: number) => axios.patch(HOST_NAME + API_EXTENSION + ROUTE_GROUP + `/${id}/change-status`);
export const deleteColor = (id: number) => axios.delete(HOST_NAME + API_EXTENSION + ROUTE_GROUP + `/${id}/delete`);
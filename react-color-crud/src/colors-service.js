import axios from 'axios';

export const getColors = () => axios.get('http://localhost:2222/api/colors/list');
export const createColor = (name, hex_value, status) => axios.post(`http://localhost:2222/api/colors/create`, {name, hex_value, status});
export const editColor = (id) => axios.patch(`http://localhost:2222/api/colors/${id}/edit`);
export const changeStatus = (id) => axios.patch(`http://localhost:2222/api/colors/${id}/change-status`);
export const deleteColor = (id) => axios.delete(`http://localhost:2222/api/colors/${id}/delete`);
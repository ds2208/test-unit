import axios from 'axios';

export const getColors = () => axios.get('http://localhost:2222/api/colors/list');
export const createColor = (name: string, hex_value: string, status: boolean) => axios.post(`http://localhost:2222/api/colors/create`, {name, hex_value, status});
export const editColor = (id: number) => axios.patch(`http://localhost:2222/api/colors/${id}/edit`);
export const changeStatus = (id: number) => axios.patch(`http://localhost:2222/api/colors/${id}/change-status`);
export const deleteColor = (id: number) => axios.delete(`http://localhost:2222/api/colors/${id}/delete`);
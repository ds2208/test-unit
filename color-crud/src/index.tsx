import React from 'react';
import ReactDOM from 'react-dom/client';
import reportWebVitals from './reportWebVitals';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import './index.css';

import Header from './components/_layout/header/Header';
import List from './components/colors/List';
import Create from './components/colors/Create';
import Dashboard from './components/Dashboard';


const navItems = [
  {
    id: 1,
    name: "List",
    link: "/colors"
  },
  {
    id: 2,
    name: "Create",
    link: "/colors/new"
  }
];

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
  <React.StrictMode>
    <Header navItems={navItems} />
    <BrowserRouter>
        <Routes>
          <Route index element={<Dashboard />} />
          <Route path='/colors' element={<List />} />
          <Route path='/colors/new' element={<Create />} />
        </Routes>
    </BrowserRouter>
  </React.StrictMode>
);
// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();

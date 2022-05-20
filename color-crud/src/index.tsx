import React from 'react';
import ReactDOM from 'react-dom/client';
import reportWebVitals from './reportWebVitals';
import { BrowserRouter, Route, Routes, useLocation } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import './index.css';

import Header from './components/_layout/header/Header';
import List from './components/colors/List';
import Create from './components/colors/Create';
import Dashboard from './components/Dashboard';
import Edit from './components/colors/Edit';


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
<>
    <Header navItems={navItems} />
    <BrowserRouter>
        <Routes>
          <Route index element={<Dashboard />} />
          <Route path='colors'>
            <Route path='' element={<List />} />
            <Route path='new' element={<Create />} />
            <Route path=':id/edit' element={<Edit />} />
          </Route>
        </Routes>
    </BrowserRouter>
    </>
);
// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();

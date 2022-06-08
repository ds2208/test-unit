import { BrowserRouter, Route, Routes } from 'react-router-dom';

import Header from './components/_layout/header/Header';
import Dashboard from './components/Dashboard';
import List from './components/colors/List';
import Create from './components/colors/Create';
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

function App() {

  return (
    <>
      <BrowserRouter>
        <Header navItems={navItems} />
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
}

export default App;

import React, {useEffect, useState} from "react";
import { getColors } from "./colors-service";
import "./style/app.css";
import Table from "./components/Table";
import Form from "./components/Form";

function App() {

  const [colors, setColors] = useState([]);

  useEffect(()=> {
    getColors().then(result => {
      setColors(result.data);
    })
  }, []);

  return (
    <>
      <Table 
        colors = {colors} 
        setColors = {setColors}
        />
      <Form 
        colors = {colors} 
        setColors = {setColors} 
        />
    </>
  );
}

export default App;

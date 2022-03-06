import React, {useState} from "react";
import { createColor } from "../colors-service";

function Form({setColors}) {
    const [name, setName] = useState("");
    const [hexValue, setHexValue] = useState('#');
    const [status, setStatus] = useState(0);

    return (
      <>
      <div id="form">
        <h2 id="form-title">Create new Color</h2>
        <div id="form-container">
          <div className="form-group">
              <label htmlFor="color-name">Name: </label>
              <input id="color-name" type="text" onChange={(element) => {setName(element.target.value)}}/>
          </div>
          <div className="form-group">
              <label htmlFor="color-hex-value">Hex Value: </label>
              <input id="color-hex-value" type="text" onChange={(element) => {setHexValue(element.target.value)}}/>
          </div>
          <div className="form-group">
              <label htmlFor="color-status">Status: </label>
              <input id="color-status" type="checkbox" onChange={(element) => {setStatus(element.target.value)}}/>
          </div>
        </div>
        <div id="submit-btn-container">
          <button onClick={() => {
              createColor(name, hexValue, status).then(result => {
                setColors(prev => [...prev, result.data]);
              });
          }}>Create</button>
        </div>
      </div>
      </>
    );
}

export default Form;

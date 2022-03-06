import React, {useState} from "react";
import { createColor, editColor } from "../colors-service";

function Form({colors, setColors}) {
    const [name, setName] = useState("");
    const [hexValue, setHexValue] = useState("");
    const [status, setStatus] = useState(false);
    const [errors, setErrors] = useState("");

    return (
      <>
      <div id="form">
        <h2 id="form-title">Create new Color</h2>
        <div id="form-container">
          <div className="form-group">
              <label htmlFor="color-name">Name: </label>
              <input id="color-name" type="text" value={name} onChange={(element) => {setName(element.target.value)}}/>
          </div>
          <div className="form-group">
              <label htmlFor="color-hex-value">Hex Value: </label>
              <input id="color-hex-value" type="text" value={hexValue} onChange={(element) => {setHexValue(element.target.value)}}/>
          </div>
          <div className="form-group">
              <label htmlFor="color-status">Status: </label>
              <input id="color-status" type="checkbox" checked={status} onChange={(element) => {setStatus(element.target.checked)}}/>
          </div>
        <div className="error-msg">{errors}</div>
        </div>
        <div id="submit-btn-container">
          <button onClick={() => {
              let colorsCOU = colors.filter(function(color){ 
                return color.name === name;
              });
              if(colorsCOU.length < 1) {
                createColor(name, hexValue, status).then(result => {
                    if(result.data.status === "ok") {
                        setColors(prev => [...prev, result.data.data]);
                        setErrors("");
                        setName("");
                        setHexValue("");
                        setStatus(false);
                    }
                }).catch(error => {
                    setErrors("Invalid data!");
                });
              } else {
                editColor(colorsCOU[0].id).then(result => {
                    if(result.data.status === "ok") {
                        setColors(prev => [...prev, result.data.data]);
                        setErrors("");
                        setName("");
                        setHexValue("");
                        setStatus(false);
                    }
                }).catch(error => {
                    setErrors("Invalid data!");
                });
              }
          }}>Save</button>
        </div>
      </div>
      </>
    );
}

export default Form;

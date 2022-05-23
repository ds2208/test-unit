import { useState } from "react";
import { IoCloseCircleOutline, IoColorWandOutline, IoGitCompareOutline } from "react-icons/io5";
import { useNavigate } from "react-router-dom";
import { changeStatus } from "../../../services/colors-service";

function Color({ color, removeColor }: ColorProps) {

  const navigate = useNavigate();
  const [id, setId] = useState(color.id);
  const [name, setName] = useState(color.name);
  const [hex_value, setHexValue] = useState(color.hex_value);
  const [status, setStatus] = useState(color.status);


  const changeActive = (colorId: number): any => {
    const response = changeStatus(colorId);
    response.catch(errors => {
      console.log(errors);
    }).then(result => {
      if (result) {
        setStatus(result.data.data.color.status);
      }
    });
  }

  const fetchToChangeColor = (colorId: number): any => {
    navigate(`/colors/${colorId}/edit`);
  }

  return (
    <tr>
      <td>{id ?? "#"}</td>
      <td>{name ?? ""}</td>
      <td>{hex_value ?? "N/A"}</td>
      <td className={status ? "text-success" : "text-danger"}>{status ? "Active" : "Disabled"}</td>
      <td>
        <a className='btn btn-outline-warning m-3' onClick={() => (fetchToChangeColor(id))}>
          <IoColorWandOutline />
        </a>
        <a className='btn btn-outline-info m-3' onClick={() => (changeActive(id))}>
          <IoGitCompareOutline />
        </a>
        <a className='btn btn-outline-danger m-3' onClick={() => (removeColor(id))}>
          <IoCloseCircleOutline />
        </a>
      </td>
    </tr>
    // <td>{<Action actionColor = {color} colorStatus = {colorStatus} setColorStatus = {setColorStatus} colors = {colors} setColors = {setColors}/>}</td>
  );
}

interface ColorProps {
  color: {
    id: number,
    name: string,
    hex_value: string,
    status: boolean
  },
  removeColor: any
};

export default Color;
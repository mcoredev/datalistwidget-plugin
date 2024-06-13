# OCTOBER CMS Datalist FormWidget
Simple datalist form widget with input text for custom value. This widget not using `<datalist>` tag. It is something like `taglist` in OCMS, but little bit different.

**The widget mostly works only with text as value. The value as a key is only an enrichment of the function.**

<img width="404" alt="Snímka obrazovky 2024-06-12 o 17 17 16" src="https://github.com/mcoredev/datalistwidget-plugin/assets/18698910/c02c0851-6b81-4003-bf2f-2ff4677e3c53">

## Example of config fields
```
approved_by:
    label: Approved
    type: datalist
    useOptionKey: true/false
    useGroupKey: true/false
    maxItems: 10
    optionsMethod: getMethodFieldOptions 
    options:
       - Option 1
       - Option 2
    options:
       key_1: Option 1
       key_2: Option 2
``` 

- `useOptionKey: true/false - default(false)` - use if you want to get an array key like value into the input
- `useGroupKey: true/false - default(false)` - use if the array is sorted into groups and each group has its own key
- `maxItems: 10 - default(5)` - how many records show on list, then scroll down

> [!IMPORTANT]
> If you set `useOptionKey: true` or `useGroupKey: true` based on your scenario widget return key like value into input.


```
approved_by:
    label: Approved
    type: datalist
    useOptionKey: true
    options:
       key_1: Option 1
       key_2: Option 2
``` 

```
approved_by:
    label: Approved
    type: datalist
    options:
       - Option 1
       - Option 2
```

```
approved_by:
    label: Approved
    type: datalist
    useOptionKey: true
    useGroupKey: true
    maxItems: 5
    optionsMethod: getMethodFieldOptions 
``` 
## Simple array

**config/field**
- type: datalist
- maxItems: 5
- optionsMethod: getMethodFieldOptions 

```
public function getMethodFieldOptions()
{
    return [
        'Item 1',
        'Item 2',
        'Item 3',
        'Item 4',
        'Item 5',
        'Item 6',
    ];
}
```

## Key vs. value array

**config/field**
- type: datalist
- maxItems: 5
- useOptionKey: true
- optionsMethod: getMethodFieldOptions

The input value will be the key of the array

```
public function getMethodFieldOptions()
{
    return [
        'key_1' => 'Item 1',
        'key_2' => 'Item 2',
        'key_3' => 'Item 3',
        'key_4' => 'Item 4',
        'key_5' => 'Item 5',
        'key_6' => 'Item 6',
    ];
}
```
> [!NOTE]
> The widget will automatically recognize the group array.

## Simple groups array

**config/field**
- type: datalist
- maxItems: 5
- useOptionKey: true
- optionsMethod: getMethodFieldOptions

The input value will be the key of the array for items. For group will be only text.

```
public function getMethodFieldOptions()
{
    return [
        'Group 1' => [
            'key_1' => 'Item 1',
            'key_2' => 'Item 2',
            'key_3' => 'Item 3',
        ],
        'Group 2' => [
            'key_2_1' => 'Item 2_1',
            'key_2_2' => 'Item 2_2',
            'key_2_3' => 'Item 2_3',
        ],
    ];
}
```

## Group type array with keys
The `useGroupKey: true` attribute must be enabled in the field configuration, then the value of group will be eg. `key_group_1`

**config/field**
- type: datalist
- maxItems: 5
- useGroupKey: true
- optionsMethod: getMethodFieldOptions

The input value will be the key of the array for groups. For items will be only text.

If you want key items like value turn on `useOptionKey: true`

```
public function getMethodFieldOptions()
{
    return [
        'key_group_1' => [
            'name' => 'Key Group 1',
            'items' => [
                'key_1' => 'Item 1',
                'key_2' => 'Item 2',
                'key_3' => 'Item 3',
            ],
        ],
        'key_group_2' => [
            'name' => 'Key Group 2',
            'items' => [
                'key_2_1' => 'Item 2_1',
                'key_2_2' => 'Item 2_2',
                'key_2_3' => 'Item 2_3',
            ],
        ],
    ];
}
```

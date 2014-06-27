url_title_to_entry_id.pi.ee_addon
=================================

This simple plug-in takes any given URL title and returns the corresponding entry ID. This is useful when you have only a URL title available as a segment and need to be able to pass the corresponding entry ID to a template tag in the page.

The URL title to entry ID Plugin simply returns the corresponding entry ID for a given URL title. You can also optionally specify a channel if you have URL_title conflicts.

```{exp:url_title_to_entry_id url_title="{segment_2}" channel="channel_short_name"}```

Just specify the channel short name (optional) and URL title you wish to return an entry ID for as parameters and away you go. Simples.
